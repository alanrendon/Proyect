<?php
/* Copyright (C) 2004      Rodolphe Quiedeville  <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2011 Laurent Destailleur   <eldy@users.sourceforge.net>
 * Copyright (C) 2005      Marc Barilley / Ocebo <marc@ocebo.com>
 * Copyright (C) 2005-2012 Regis Houssin         <regis.houssin@capnetworks.com>
 * Copyright (C) 2013	   Marcos García		 <marcosgdf@gmail.com>
 * Copyright (C) 2015	   Juanjo Menent		 <jmenent@2byte.es>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	    \file       htdocs/compta/paiement/card.php
 *		\ingroup    facture
 *		\brief      Page of a customer payment
 *		\remarks	Nearly same file than fournisseur/paiement/card.php
 */

require '../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/compta/paiement/class/paiement.class.php';
require_once DOL_DOCUMENT_ROOT.'/compta/facture/class/facture.class.php';
require_once DOL_DOCUMENT_ROOT .'/core/modules/facture/modules_facture.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/payments.lib.php';
require_once DOL_DOCUMENT_ROOT.'/ctrlanticipo/libs/advance.lib.php';
if (! empty($conf->banque->enabled)) require_once DOL_DOCUMENT_ROOT.'/compta/bank/class/account.class.php';
dol_include_once('/ctrlanticipo/class/ctrladvanceproviderpayment.class.php');
$langs->load('bills');
$langs->load('banks');
$langs->load('companies');

// Security check
$id=GETPOST('id','int');
$action=GETPOST('action','alpha');
$confirm=GETPOST('confirm','alpha');
if ($user->societe_id) $socid=$user->societe_id;
// TODO ajouter regle pour restreindre acces paiement
//$result = restrictedArea($user, 'facture', $id,'');

$object = new PaiementAdvance($db);


/*
 * Actions
 */

if ($action == 'setnote')
{
    $db->begin();

    $object->fetch($id);
    $result = $object->update_note(GETPOST('note'));	
    if ($result > 0)
    {
        $db->commit();
        $action='';
    }
    else
    {
	    setEventMessages($object->error, $object->errors, 'errors');
        $db->rollback();
    }
}

if ($action == 'confirm_delete' && $confirm == 'yes')
{
	$db->begin();
	$object->fetch($id);
	$result = $object->delete();
	//echo $result;

	//die("");

	if ($result > 0)
	{
        $db->commit();
        header("Location: ctrlpaiementfourn_list.php");
        exit;
	}
	else
	{
	    $langs->load("errors");
		setEventMessages($object->error, $object->errors, 'errors');
        $db->rollback();
	}
}



if ($action == 'confirm_valide' && $confirm == 'yes')
{
	$db->begin();

    $object->fetch($id);
	if ($object->valide() > 0)
	{
		$db->commit();

		// Loop on each invoice linked to this payment to rebuild PDF
		$factures=array();
		foreach($factures as $id)
		{
			$fac = new Facture($db);
			$fac->fetch($id);

			$outputlangs = $langs;
			if (! empty($_REQUEST['lang_id']))
			{
				$outputlangs = new Translate("",$conf);
				$outputlangs->setDefaultLang($_REQUEST['lang_id']);
			}
			if (empty($conf->global->MAIN_DISABLE_PDF_AUTOUPDATE)) {
				$fac->generateDocument($fac->modelpdf, $outputlangs);
			}
		}

		header('Location: '.$_SERVER['PHP_SELF'].'?id='.$object->id);
		exit;
	}
	else
	{
	    $langs->load("errors");
		setEventMessages($object->error, $object->errors, 'errors');
		$db->rollback();
	}
}

if ($action == 'setnum_paiement' && ! empty($_POST['num_paiement']))
{
	$object->fetch($id);
    $res = $object->update_num($_POST['num_paiement'],$user);
	if ($res === 0)
	{
		setEventMessages($langs->trans('PaymentNumberUpdateSucceeded'), null, 'mesgs');
	}
	else
	{
		setEventMessages($langs->trans('PaymentNumberUpdateFailed'), null, 'errors');
	}
}

if ($action == 'setdatep' && ! empty($_POST['datepday']))
{
	$object->fetch($id);
    $datepaye = dol_mktime(12, 0, 0, $_POST['datepmonth'], $_POST['datepday'], $_POST['datepyear']);
	$res = $object->update_date($datepaye,$user);
	if ($res === 0)
	{
		setEventMessages($langs->trans('PaymentDateUpdateSucceeded'), null, 'mesgs');
	}
	else
	{
		setEventMessages($langs->trans('PaymentDateUpdateFailed'), null, 'errors');
	}
}


/*
 * View
 */

llxHeader();

	$thirdpartystatic=new Societe($db);

	$result=$object->fetch($id);

	if ($result <= 0)
	{
		dol_print_error($db,'Payement '.$id.' not found in database');
		exit;
	}

	$form = new Form($db);

	$head = advance_payment_prepare_head($object);

	dol_fiche_head($head, 'payment', $langs->trans("ctrl_paiment_advance"), 0, 'payment');

	/*
	 * Confirmation de la suppression du paiement
	 */
	if ($action == 'delete')
	{
		print $form->formconfirm($_SERVER['PHP_SELF'].'?id='.$object->id, $langs->trans("DeletePayment"), $langs->trans("ConfirmDeletePayment"), 'confirm_delete','',0,2);
	}

	/*
	 * Confirmation de la validation du paiement
	 */
	if ($action == 'valide')
	{
		$facid = $_GET['facid'];
		print $form->formconfirm($_SERVER['PHP_SELF'].'?id='.$object->id.'&amp;facid='.$facid, $langs->trans("ValidatePayment"), $langs->trans("ConfirmValidatePayment"), 'confirm_valide','',0,2);

	}
	
	print '<table class="border" width="100%">';

	$linkback = '<a href="' . DOL_URL_ROOT . '/ctrlanticipo/view/ctrlpaiementfourn_list.php">' . $langs->trans("BackToList") . '</a>';


	// Ref
	print '<tr><td class="titlefield">'.$langs->trans('Ref').'</td><td colspan="3">';
	print $form->showrefnav($object, 'id', $linkback,0);
	print '</td></tr>';

	// Date payment
	print '<tr><td>'.$form->editfieldkey("Date",'datep',$object->date,$object,$user->rights->facture->paiement).'</td><td colspan="3">';
	print $form->editfieldval("Date",'datep',$object->date,$object,$user->rights->facture->paiement,'datepicker','',null,$langs->trans('PaymentDateUpdateSucceeded'));
	print '</td></tr>';

	// Payment type (VIR, LIQ, ...)
	$labeltype=$langs->trans("PaymentType".$object->type_code)!=("PaymentType".$object->type_code)?$langs->trans("PaymentType".$object->type_code):$object->type_libelle;
	print '<tr><td>'.$langs->trans('PaymentMode').'</td><td colspan="3">'.$labeltype.'</td></tr>';

	// Payment numero
	print '<tr><td>'.$form->editfieldkey("Numero",'num_paiement',$object->numero,$object,$object->statut == 0 && $user->rights->fournisseur->facture->creer).'</td><td colspan="3">';
	print $form->editfieldval("Numero",'num_paiement',$object->numero,$object,$object->statut == 0 && $user->rights->fournisseur->facture->creer,'string','',null,$langs->trans('PaymentNumberUpdateSucceeded'));
	print '</td></tr>';

	// Amount
	print '<tr><td>'.$langs->trans('Amount').'</td><td colspan="3">'.price($object->montant,'',$langs,0,0,-1,$conf->currency).'</td></tr>';

	// Note
	print '<tr><td class="tdtop">'.$form->editfieldkey("Note",'note',$object->note,$object,$user->rights->facture->paiement).'</td><td colspan="3">';
	print $form->editfieldval("Note",'note',$object->note,$object,$user->rights->facture->paiement,'textarea');
	print '</td></tr>';

	$disable_delete = 0;
	// Bank account
	if (! empty($conf->banque->enabled))
	{
	    if ($object->bank_account)
	    {
	    	$bankline=new AccountLine($db);
	    	$res_line_bank=$bankline->fetch($object->bank_line);
	    	if ($res_line_bank) {
	    		if ($bankline->rappro)
		        {
		            $disable_delete = 1;
		            $title_button = dol_escape_htmltag($langs->transnoentitiesnoconv("CantRemoveConciliatedPayment"));
		        }

		    	print '<tr>';
		    	print '<td>'.$langs->trans('BankTransactionLine').'</td>';
				print '<td colspan="3">';
				print $bankline->getNomUrl(1,0,'showconciliated');
		    	print '</td>';
		    	print '</tr>';

				if ($object->type_code == 'CHQ' && $bankline->fk_bordereau > 0) 
				{
					dol_include_once('/compta/paiement/cheque/class/remisecheque.class.php');
					$bordereau = new RemiseCheque($db);
					$bordereau->fetch($bankline->fk_bordereau);
					print '<tr>';
			    	print '<td>'.$langs->trans('CheckReceipt').'</td>';
					print '<td colspan="3">';
					print $bordereau->getNomUrl(1);
			    	print '</td>';
			    	print '</tr>';
				}
	    	}
	    	print '<tr>';
	    	print '<td>'.$langs->trans('BankAccount').'</td>';
			print '<td colspan="3">';
			$accountstatic=new Account($db);
	        
			$accountstatic->fetch($object->bank_account);
	        print $accountstatic->getNomUrl(0);
	    	print '</td>';
	    	print '</tr>';
	        
	    }
	}

	print '</table>';


	/*
		* List of invoices
	*/

	$sql = 'SELECT a.* FROM llx_ctrl_paiementfourn_facturefourn as a WHERE a.fk_paiementfourn='.$object->id;
	$resql=$db->query($sql);
	
	if ($resql)
	{
		$num = $db->num_rows($resql);

		$i = 0;
		$total = 0;
		print '<br><table class="noborder" width="100%">';
		print '<tr class="liste_titre">';
		print '<td>'.$langs->trans('Bill').'</td>';
		print '<td>'.$langs->trans('Company').'</td>';
		print '<td align="right">'.$langs->trans('ExpectedToPay').'</td>';
	    print '<td align="right">'.$langs->trans('PayedByThisPayment').'</td>';
	    print '<td align="right">'.$langs->trans('RemainderToPay').'</td>';
	    print '<td align="right">'.$langs->trans('Status').'</td>';
		print "</tr>\n";

		if ($num > 0)
		{
			$var=True;

			while ($i < $num)
			{
				$objp = $db->fetch_object($resql);
				$var=!$var;
				print '<tr '.$bc[$var].'>';

	            $invoice=new Ctrladvanceprovider($db);
	            $res=$invoice->fetch($objp->fk_facturefourn);
				print '<td>';
				print $invoice->getNomUrl(1);
				print "</td>\n";

				// Third party
				print '<td>';
				$thirdpartystatic->fetch($invoice->fk_soc);
				print $thirdpartystatic->getNomUrl(1);
				print '</td>';

				// Expected to pay
				print '<td align="right">'.price($invoice->total_import).'</td>';

	            // Amount payed
	            print '<td align="right">'.price($objp->amount).'</td>';

	            // Remain to pay
	            
	            print '<td align="right">'.price($invoice->total_import-$objp->amount).'</td>';

				// Status
				print '<td align="right"><span class="hideonsmartphone"> '.$langs->trans('ctrl_action_statut'.$invoice->statut)."</span>  ".img_picto($langs->trans('ctrl_action_statut'.$invoice->statut),'statut'.(($invoice->statut==5)?7:$invoice->statut)).'</td>';

				print "</tr>\n";
				if ($objp->paye == 1)	// If at least one invoice is paid, disable delete
				{
					$disable_delete = 1;
					$title_button = dol_escape_htmltag($langs->transnoentitiesnoconv("CantRemovePaymentWithOneInvoicePaid"));
				}
				$total = $total + $objp->amount;
				$i++;
			}
		}
		$var=!$var;

		print "</table>\n";
		$db->free($resql);
	}
	else
	{
		dol_print_error($db);
	}

	print '</div>';


	/*
		* Boutons Actions
	*/


	print '<div class="tabsAction">';
	



	if (! empty($conf->global->BILL_ADD_PAYMENT_VALIDATION))
	{
		if ($user->societe_id == 0 && $object->statut == 0 && $_GET['action'] == '')
		{
			if ($user->rights->facture->paiement)
			{
				print '<a class="butAction" href="'.$_SERVER['PHP_SELF'].'?id='.$id.'&amp;facid='.$objp->facid.'&amp;action=valide">'.$langs->trans('Valid').'</a>';
			}
		}
	}

	if ($user->societe_id == 0 )
	{
		if ($user->rights->ctrlanticipo->ctrlanticipo6->emitpayment) {
			print '<a class="butActionDelete" href="'.$_SERVER['PHP_SELF'].'?id='.$id.'&amp;action=delete">'.$langs->trans('Delete').'</a>';
			
		}else
		{

			print '<a class="butActionRefused" href="#" title="'.$title_button.'">'.$langs->trans('Delete').'</a>';
		}
		
	}


	print '</div>';

	



llxFooter();

$db->close();
