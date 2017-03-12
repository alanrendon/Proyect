<?php

/* 					JPFarber - jfarber55@hotmail.com
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
 * 
 * code pour créer le module 106, 117, 97, 110, b, 112, 97, 98, 108, 11, b, 102, 97, 114, 98, 101, 114
 */

/**
 * 	\defgroup   contab     Module contab
 *  \brief      Example of a module descriptor.
 * 				Such a file must be copied into htdocs/contab/core/modules directory.
 *  \file       htdocs/contab/core/modules/modcontab.class.php
 *  \ingroup    contab
 *  \brief      Description and activation file for module contab
 */
include_once DOL_DOCUMENT_ROOT . '/core/modules/DolibarrModules.class.php';

/**
 *  Description and activation class for module contab
 */
class modContab extends DolibarrModules {

    /**
     *   Constructor. Define names, constants, directories, boxes, permissions
     *
     *   @param      db		$db      Database handler
     */
    function __construct($db) {
        global $langs, $conf;

        $this->db = $db;

        // Id for module (must be unique).
        // Use here a free id (See in Home -> System information -> Dolibarr for list of used modules id).
        $this->numero = 400999;
        // Key text used to identify module (for permissions, menus, etc...)
        $this->rights_class = 'contab';

        // Family can be 'crm','financial','hr','projects','products','ecm','technic','other'
        // It is used to group modules in module setup page
        $this->family = "financial";
        // Module label (no space allowed), used if translation string 'ModuleXXXName' not found (where XXX is value of numeric property 'numero' of module)
        $this->name ='Contab PRO';
        // Module description, used if translation string 'ModuleXXXDesc' not found (where XXX is value of numeric property 'numero' of module)
        $this->description = "Contab PRO- Módulo para el manejo de movimentos contables, llevando el Libro Diario y Cuentas de Mayor, entre otras utilerías.";
        // Possible values for version are: 'development', 'experimental', 'dolibarr' or version
        $this->version = 'C-PRO 1.0';
        // Key used in llx_const table to save module status enabled/disabled (where contab is value of property name of module in uppercase)
        $this->const_name = 'MAIN_MODULE_' . strtoupper('contab');
        // Where to store the module in setup page (0=common,1=interface,2=others,3=very specific)
        $this->special = 0;
        // Name of image file used for this module.
        // If file is in theme/yourtheme/img directory under name object_pictovalue.png, use this->picto='pictovalue'
        // If file is in module/img directory under name object_pictovalue.png, use this->picto='pictovalue@module'
        $this->picto='accounting';

        $this->module_parts = array(
           	'triggers' => 0,                                 // Set this to 1 if module has its own trigger directory (/mymodule/core/triggers)
			'login' => 0,                                    // Set this to 1 if module has its own login method directory (/mymodule/core/login)
			'substitutions' => 0,                            // Set this to 1 if module has its own substitution function file (/mymodule/core/substitutions)
			'menus' => 0,                                    // Set this to 1 if module has its own menus handler directory (/mymodule/core/menus)
			'theme' => 0,                                    // Set this to 1 if module has its own theme directory (/mymodule/theme)
           	'tpl' => 0,                                      // Set this to 1 if module overwrite template dir (/mymodule/core/tpl)
			'barcode' => 0,                                  // Set this to 1 if module has its own barcode directory (/mymodule/core/modules/barcode)
			'models' => 0,                                   // Set this to 1 if module has its own models directory (/mymodule/core/modules/xxx)
			//'css' => '', 									// Set this to relative path of css file if module has its own css file
			'hooks' => array('toprightmenu'
						)
			//'workflow' => array(''=>array('enabled'=>'! empty($conf->module1->enabled) && ! empty($conf->module2->enabled)', 'picto'=>'yourpicto@mymodule') // Set here all workflow context managed by module
        );

        // Data directories to create when module is enabled.
        // Example: this->dirs = array("/contab/temp");
        $this->dirs = array();

        // Config pages. Put here list of php page, stored into contab/admin directory, to use to setup module.
        $this->config_page_url = array('admin.php@contab');

        // Dependencies
        $this->hidden                = false;   // A condition to hide module
        $this->depends               = array();  // List of modules id that must be enabled if this module is enabled
        $this->requiredby            = array(); // List of modules id to disable if this one is disabled
        $this->conflictwith          = array(); // List of modules id this module is in conflict with
        $this->phpmin                = array(5, 0);     // Minimum version of PHP required by module
        $this->need_dolibarr_version = array(3, 6); // Minimum version of Dolibarr required by module
        //$this->langfiles = array("mylangfile@contab");

        $this->const = array();
        
        // Array to add new pages in new tabs
		// Example: $this->tabs = array('objecttype:+tabname1:Title1:mylangfile@mymodule:$user->rights->mymodule->read:/mymodule/mynewtab1.php?id=__ID__',  	// To add a new tab identified by code tabname1
        //                              'objecttype:+tabname2:Title2:mylangfile@mymodule:$user->rights->othermodule->read:/mymodule/mynewtab2.php?id=__ID__',  	// To add another new tab identified by code tabname2
        //                              'objecttype:-tabname:NU:conditiontoremove');                                                     						// To remove an existing tab identified by code tabname
		// where objecttype can be
		// 'categories_x'	  to add a tab in category view (replace 'x' by type of category (0=product, 1=supplier, 2=customer, 3=member)
		// 'contact'          to add a tab in contact view
		// 'contract'         to add a tab in contract view
		// 'group'            to add a tab in group view
		// 'intervention'     to add a tab in intervention view
		// 'invoice'          to add a tab in customer invoice view
		// 'invoice_supplier' to add a tab in supplier invoice view
		// 'member'           to add a tab in fundation member view
		// 'opensurveypoll'	  to add a tab in opensurvey poll view
		// 'order'            to add a tab in customer order view
		// 'order_supplier'   to add a tab in supplier order view
		// 'payment'		  to add a tab in payment view
		// 'payment_supplier' to add a tab in supplier payment view
		// 'product'          to add a tab in product view
		// 'propal'           to add a tab in propal view
		// 'project'          to add a tab in project view
		// 'stock'            to add a tab in stock view
		// 'thirdparty'       to add a tab in third party view
		// 'user'             to add a tab in user view
		//$this->tabs = array('invoice:+tabpolizas:Polizas:mylangfile@contab:$user->rights->contab->read:/contab/tabs/polizas.php?id=__ID__');
		//$this->tabs = array('invoice:+tabpollizas:Polizas:@hwtitle:true:/contab/tabs/polizas.php?id=__ID__');
		
        
        //$this->tabs[] = 'categories_1:+tabcustcuentas:Cuentas:@hwtitle:true:/custom/contab/modules/fourn/fiche.php?socid=__ID__';
        
        // Dictionnaries
        if (!isset($conf->contab->enabled)) {
            $conf->contab          = new stdClass();
            $conf->contab->enabled = 0;
        }

        // Boxes
        // Add here list of php file(s) stored in core/boxes that contains class to show a box.
        $this->boxes = array();   // List of boxes
        // Example:
        //$this->boxes=array(array(0=>array('file'=>'myboxa.php','note'=>'','enabledbydefaulton'=>'Home'),1=>array('file'=>'myboxb.php','note'=>''),2=>array('file'=>'myboxc.php','note'=>'')););
        // Permissions
        $this->rights = array();  // Permission array used by this module
        $r = 0;
        //Perms
        $this->rights[$r][0] = 4031187;
        $this->rights[$r][1] = 'Acceso a Contabilidad';
        $this->rights[$r][3] = 0;
        $this->rights[$r][4] = 'acceso';
        $r++;
        
        // Main menu entries
        $this->menu = array();   // List of menus to add
        $r = 0;

        // Add here entries to declare new menus
        //`
        
        /* $this->menu[$r]=array('fk_menu'=>'fk_mainmenu=contabilidad',			// Put 0 if this is a top menu
        	'type'=>'top',			// This is a Top menu entry
        	'titre'=>'Contab',
        	'mainmenu'=>'contabilidad',
        	'leftmenu'=>'Contab',
        	'url'=>'http://www.google.com',
        	//'langs'=>'contab@contab',	// Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
        	'position'=>100,
        	'enabled'=>'$user->rights->contab->acceso',			// Define condition to show or hide menu entry. Use '$conf->mymodule->enabled' if entry must be visible if module is enabled.
        	'perms'=>'$user->rights->contab->acceso',			// Use 'perms'=>'$user->rights->mymodule->level1->level2' if you want your menu with a permission rules
        	'target'=>'_blank',
        	'user'=>0);				// 0=Menu for internal users, 1=external users, 2=both
        $r++; */
        
		/* // Example to declare a new Top Menu entry and its Left menu entry:
        $this->menu[$r] = array('fk_menu' => 'fk_mainmenu=mainmenucontab,fk_leftmenu=leftmenucontab', // Put 0 if this is a top menu
            'type' => 'left', // This is a Top menu entry
            'titre' => 'Contabilidad',
       		'mainmenu'=>'mainmenucontab',
        	'leftmenu'=>'leftmenucontabilidad',
            'url' => '',
            'langs' => 'contab@contab', // Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
            'position' => 100,
            'enabled' => '$user->rights->contab->cont', // Define condition to show or hide menu entry. Use '$conf->doliwaste->enab
            'perms' => '$user->rights->conta->cont', // Use 'perms'=>'$user->rights->doliwaste->level1->level2' if you
            'target' => '',
            'user' => 2);                    // 0=Menu for internal users, 1=external users, 2=both
        $r++; */

        // Exports Example:
        // $this->export_code[$r]=$this->rights_class.'_'.$r;
        // $this->export_label[$r]='CustomersInvoicesAndInvoiceLines';	// Translation key (used only if key ExportDataset_xxx_z not found)
        // $this->export_enabled[$r]='1';                               // Condition to show export in list (ie: '$user->id==3'). Set to 1 to always show when module is enabled.
        // $this->export_permission[$r]=array(array("facture","facture","export"));
        // $this->export_fields_array[$r]=array('s.rowid'=>"IdCompany",'s.nom'=>'CompanyName','s.address'=>'Address','s.zip'=>'Zip','s.town'=>'Town','s.fk_pays'=>'Country','s.phone'=>'Phone','s.siren'=>'ProfId1','s.siret'=>'ProfId2','s.ape'=>'ProfId3','s.idprof4'=>'ProfId4','s.code_compta'=>'CustomerAccountancyCode','s.code_compta_fournisseur'=>'SupplierAccountancyCode','f.rowid'=>"InvoiceId",'f.facnumber'=>"InvoiceRef",'f.datec'=>"InvoiceDateCreation",'f.datef'=>"DateInvoice",'f.total'=>"TotalHT",'f.total_ttc'=>"TotalTTC",'f.tva'=>"TotalVAT",'f.paye'=>"InvoicePaid",'f.fk_statut'=>'InvoiceStatus','f.note'=>"InvoiceNote",'fd.rowid'=>'LineId','fd.description'=>"LineDescription",'fd.price'=>"LineUnitPrice",'fd.tva_tx'=>"LineVATRate",'fd.qty'=>"LineQty",'fd.total_ht'=>"LineTotalHT",'fd.total_tva'=>"LineTotalTVA",'fd.total_ttc'=>"LineTotalTTC",'fd.date_start'=>"DateStart",'fd.date_end'=>"DateEnd",'fd.fk_product'=>'ProductId','p.ref'=>'ProductRef');
        // $this->export_entities_array[$r]=array('s.rowid'=>"company",'s.nom'=>'company','s.address'=>'company','s.zip'=>'company','s.town'=>'company','s.fk_pays'=>'company','s.phone'=>'company','s.siren'=>'company','s.siret'=>'company','s.ape'=>'company','s.idprof4'=>'company','s.code_compta'=>'company','s.code_compta_fournisseur'=>'company','f.rowid'=>"invoice",'f.facnumber'=>"invoice",'f.datec'=>"invoice",'f.datef'=>"invoice",'f.total'=>"invoice",'f.total_ttc'=>"invoice",'f.tva'=>"invoice",'f.paye'=>"invoice",'f.fk_statut'=>'invoice','f.note'=>"invoice",'fd.rowid'=>'invoice_line','fd.description'=>"invoice_line",'fd.price'=>"invoice_line",'fd.total_ht'=>"invoice_line",'fd.total_tva'=>"invoice_line",'fd.total_ttc'=>"invoice_line",'fd.tva_tx'=>"invoice_line",'fd.qty'=>"invoice_line",'fd.date_start'=>"invoice_line",'fd.date_end'=>"invoice_line",'fd.fk_product'=>'product','p.ref'=>'product');
        // $this->export_sql_start[$r]='SELECT DISTINCT ';
        // $this->export_sql_end[$r]  =' FROM ('.MAIN_DB_PREFIX.'facture as f, '.MAIN_DB_PREFIX.'facturedet as fd, '.MAIN_DB_PREFIX.'societe as s)';
        // $this->export_sql_end[$r] .=' LEFT JOIN '.MAIN_DB_PREFIX.'product as p on (fd.fk_product = p.rowid)';
        // $this->export_sql_end[$r] .=' WHERE f.fk_soc = s.rowid AND f.rowid = fd.fk_facture';
        // $this->export_sql_order[$r] .=' ORDER BY s.nom';
        // $r++;
        
        
		
    }

    /**
     * 		Function called when module is enabled.
     * 		The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
     * 		It also creates data directories
     *
     *      @param      string	$options    Options when enabling module ('', 'noboxes')
     *      @return     int             	1 if OK, 0 if KO
     */
    function init($options = '') {
        global $db,$conf;
    	$sql = array();
        
            $result = $this->_load_tables('/contab/sql/');
        return $this->_init($sql, $options);
    }

    /**
     * 		Function called when module is disabled.
     *      Remove from database constants, boxes and permissions from Dolibarr database.
     * 		Data directories are not deleted
     *
     *      @param      string	$options    Options when enabling module ('', 'noboxes')
     *      @return     int             	1 if OK, 0 if KO
     */
    function remove($options = '') {
        $sql = array();

        return $this->_remove($sql, $options);
    }

}

?>
