<?php
/* Copyright (C) 2007-2012  Laurent Destailleur <eldy@users.sourceforge.net>
 * Copyright (C) 2014       Juanjo Menent       <jmenent@2byte.es>
 * Copyright (C) 2015       Florian Henry       <florian.henry@open-concept.pro>
 * Copyright (C) 2015       Raphaël Doursenaud  <rdoursenaud@gpcsolutions.fr>
 * Copyright (C) ---Put here your own copyright and developer email---
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
 * \file    membercomplements/mccomplements.class.php
 * \ingroup membercomplements
 * \brief   This file is an example for a CRUD class file (Create/Read/Update/Delete)
 *          Put some comments here
 */

// Put here all includes required by your class file
require_once DOL_DOCUMENT_ROOT . '/core/class/commonobject.class.php';
//require_once DOL_DOCUMENT_ROOT . '/societe/class/societe.class.php';
//require_once DOL_DOCUMENT_ROOT . '/product/class/product.class.php';

/**
 * Class Mccomplements
 *
 * Put here description of your class
 * @see CommonObject
 */
class Mccomplements extends CommonObject
{
	/**
	 * @var string Id to identify managed objects
	 */
	public $element = 'mccomplements';
	/**
	 * @var string Name of table without prefix where object is stored
	 */
	public $table_element = 'mc_complements';

	/**
	 * @var MccomplementsLine[] Lines
	 */
	public $lines = array();

	/**
	 */
	
	public $id_provider;
	public $home_phone;
	public $m_phone1;
	public $m_phone2;
	public $q_phone1;
	public $q_phone2;
	public $primary_phone;
	public $temperature;
	public $fk_member;
	public $ref;
	public $fax;

	/**
	 */
	

	/**
	 * Constructor
	 *
	 * @param DoliDb $db Database handler
	 */
	public function __construct(DoliDB $db)
	{
		$this->db = $db;
		return 1;
	}

	/**
	 * Create object into database
	 *
	 * @param  User $user      User that creates
	 * @param  bool $notrigger false=launch triggers after, true=disable triggers
	 *
	 * @return int <0 if KO, Id of created object if OK
	 */
	public function create(User $user, $notrigger = false)
	{
		dol_syslog(__METHOD__, LOG_DEBUG);

		$error = 0;

		// Clean parameters
		if (isset($this->fk_member)) {
			 $this->fk_member = trim($this->fk_member);
		}
		if (isset($this->id_provider)) {
			 $this->id_provider = trim($this->id_provider);
		}
		if (isset($this->ref)) {
			 $this->ref = trim($this->ref);
		}
		if (isset($this->fax)) {
			 $this->fax = trim($this->fax);
		}

		
		

		if (isset($this->home_phone)) {
			 $this->home_phone = trim($this->home_phone);
		}
		if (isset($this->m_phone1)) {
			 $this->m_phone1 = trim($this->m_phone1);
		}
		if (isset($this->m_phone2)) {
			 $this->m_phone2 = trim($this->m_phone2);
		}
		if (isset($this->q_phone1)) {
			 $this->q_phone1 = trim($this->q_phone1);
		}
		if (isset($this->q_phone2)) {
			 $this->q_phone2 = trim($this->q_phone2);
		}
		if (isset($this->primary_phone)) {
			 $this->primary_phone = trim($this->primary_phone);
		}
		if (isset($this->temperature)) {
			 $this->temperature = trim($this->temperature);
		}

		

		// Check parameters
		// Put here code to add control on parameters values

		// Insert request
		$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . $this->table_element . '(';
		$sql.= 'ref,';
		$sql.= 'fax,';
		
		$sql.= 'fk_member,';
		$sql.= 'id_provider,';
		$sql.= 'home_phone,';
		$sql.= 'm_phone1,';
		$sql.= 'm_phone2,';
		$sql.= 'q_phone1,';
		$sql.= 'q_phone2,';
		$sql.= 'primary_phone,';
		$sql.= 'temperature';

		
		$sql .= ') VALUES (';
		$sql .= ' "BC200'.$this->fk_member.'",';
		$sql .= ' '.( empty($this->fax)?'NULL':$this->fax).',';
		$sql .= ' '.( empty($this->fk_member)?'NULL':$this->fk_member).',';
		$sql .= ' '.( empty($this->id_provider)?'NULL':$this->id_provider).',';
		$sql .= ' '.( empty($this->home_phone)?'NULL':"'".$this->db->escape($this->home_phone)."'").',';
		$sql .= ' '.( empty($this->m_phone1)?'NULL':"'".$this->db->escape($this->m_phone1)."'").',';
		$sql .= ' '.( empty($this->m_phone2)?'NULL':"'".$this->db->escape($this->m_phone2)."'").',';
		$sql .= ' '.( empty($this->q_phone1)?'NULL':"'".$this->db->escape($this->q_phone1)."'").',';
		$sql .= ' '.( empty($this->q_phone2)?'NULL':"'".$this->db->escape($this->q_phone2)."'").',';
		$sql .= ' '.( empty($this->primary_phone)?'NULL':$this->primary_phone).',';
		$sql .= ' '.( empty($this->temperature)?'NULL':$this->temperature);

		
		$sql .= ')';

		$this->db->begin();

		$resql = $this->db->query($sql);
		if (!$resql) {
			$error ++;
			$this->errors[] = 'Error ' . $this->db->lasterror();
			dol_syslog(__METHOD__ . ' ' . join(',', $this->errors), LOG_ERR);
		}

		if (!$error) {
			$this->id = $this->db->last_insert_id(MAIN_DB_PREFIX . $this->table_element);

			if (!$notrigger) {
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action to call a trigger.

				//// Call triggers
				//$result=$this->call_trigger('MYOBJECT_CREATE',$user);
				//if ($result < 0) $error++;
				//// End call triggers
			}
		}

		// Commit or rollback
		if ($error) {
			$this->db->rollback();

			return - 1 * $error;
		} else {
			$this->db->commit();

			return $this->id;
		}
	}

	/**
	 * Load object in memory from the database
	 *
	 * @param int    $id  Id object
	 * @param string $ref Ref
	 *
	 * @return int <0 if KO, 0 if not found, >0 if OK
	 */
	public function fetch($id, $ref = "",$id_member = "")
	{
		dol_syslog(__METHOD__, LOG_DEBUG);

		$sql = 'SELECT';
		$sql .= ' t.rowid,';
		$sql .= ' t.ref,';
		$sql .= ' t.fax,';
		
		
		$sql .= " t.fk_member,";
		$sql .= " t.id_provider,";
		$sql .= " t.home_phone,";
		$sql .= " t.m_phone1,";
		$sql .= " t.m_phone2,";
		$sql .= " t.q_phone1,";
		$sql .= " t.q_phone2,";
		$sql .= " t.primary_phone,";
		$sql .= " t.temperature";

		
		$sql .= ' FROM ' . MAIN_DB_PREFIX . $this->table_element . ' as t';

		if (empty($ref) && empty($id_member) && $id>0) {
			
			$sql .= ' WHERE t.rowid = ' . $id;
		}elseif (empty($id) && empty($id_member) && !empty($ref)) {
			$sql .= ' WHERE t.ref = ' . '\'' . $ref . '\'';
		}else{
			$sql .= ' WHERE t.fk_member = ' . $id_member;
		}
		$resql = $this->db->query($sql);
		if ($resql) {
			$numrows = $this->db->num_rows($resql);
			if ($numrows) {
				$obj = $this->db->fetch_object($resql);

				$this->id = $obj->rowid;
				$this->fk_member = $obj->fk_member;
				$this->ref = $obj->ref;
				
				$this->id_provider = $obj->id_provider;
				$this->home_phone = $obj->home_phone;
				$this->m_phone1 = $obj->m_phone1;
				$this->m_phone2 = $obj->m_phone2;
				$this->q_phone1 = $obj->q_phone1;
				$this->q_phone2 = $obj->q_phone2;
				$this->primary_phone = $obj->primary_phone;
				$this->temperature = $obj->temperature;

				
			}
			$this->db->free($resql);

			if ($numrows) {
				return 1;
			} else {
				return 0;
			}
		} else {
			$this->errors[] = 'Error ' . $this->db->lasterror();
			dol_syslog(__METHOD__ . ' ' . join(',', $this->errors), LOG_ERR);

			return - 1;
		}
	}

	/**
	 * Load object in memory from the database
	 *
	 * @param string $sortorder Sort Order
	 * @param string $sortfield Sort field
	 * @param int    $limit     offset limit
	 * @param int    $offset    offset limit
	 * @param array  $filter    filter array
	 * @param string $filtermode filter mode (AND or OR)
	 *
	 * @return int <0 if KO, >0 if OK
	 */
	public function fetchAll($sortorder='', $sortfield='', $limit=0, $offset=0, array $filter = array(), $filtermode='AND')
	{
		dol_syslog(__METHOD__, LOG_DEBUG);

		$sql = 'SELECT';
		$sql .= ' t.rowid,';
		
		$sql .= " t.id_provider,";
		$sql .= " t.home_phone,";
		$sql .= " t.m_phone1,";
		$sql .= " t.m_phone2,";
		$sql .= " t.primary_phone,";
		$sql .= " t.temperature";

		
		$sql .= ' FROM ' . MAIN_DB_PREFIX . $this->table_element. ' as t';

		// Manage filter
		$sqlwhere = array();
		if (count($filter) > 0) {
			foreach ($filter as $key => $value) {
				$sqlwhere [] = $key . ' LIKE \'%' . $this->db->escape($value) . '%\'';
			}
		}
		if (count($sqlwhere) > 0) {
			$sql .= ' WHERE ' . implode(' '.$filtermode.' ', $sqlwhere);
		}
		
		if (!empty($sortfield)) {
			$sql .= $this->db->order($sortfield,$sortorder);
		}
		if (!empty($limit)) {
		 $sql .=  ' ' . $this->db->plimit($limit + 1, $offset);
		}
		$this->lines = array();

		$resql = $this->db->query($sql);
		if ($resql) {
			$num = $this->db->num_rows($resql);

			while ($obj = $this->db->fetch_object($resql)) {
				$line = new MccomplementsLine();

				$line->id = $obj->rowid;
				
				$line->id_provider = $obj->id_provider;
				$line->home_phone = $obj->home_phone;
				$line->m_phone1 = $obj->m_phone1;
				$line->m_phone2 = $obj->m_phone2;
				$line->primary_phone = $obj->primary_phone;
				$line->temperature = $obj->temperature;

				

				$this->lines[] = $line;
			}
			$this->db->free($resql);

			return $num;
		} else {
			$this->errors[] = 'Error ' . $this->db->lasterror();
			dol_syslog(__METHOD__ . ' ' . join(',', $this->errors), LOG_ERR);

			return - 1;
		}
	}

	/**
	 * Update object into database
	 *
	 * @param  User $user      User that modifies
	 * @param  bool $notrigger false=launch triggers after, true=disable triggers
	 *
	 * @return int <0 if KO, >0 if OK
	 */
	public function update(User $user, $notrigger = false)
	{
		$error = 0;

		dol_syslog(__METHOD__, LOG_DEBUG);

		// Clean parameters
		
		if (isset($this->id_provider)) {
			 $this->id_provider = trim($this->id_provider);
		}
		if (isset($this->fk_member)) {
			 $this->fk_member = trim($this->fk_member);
		}
		if (isset($this->ref)) {
			 $this->ref = trim($this->ref);
		}
		if (isset($this->fax)) {
			 $this->fax = trim($this->fax);
		}
		

		
		
		if (isset($this->home_phone)) {
			 $this->home_phone = trim($this->home_phone);
		}
		if (isset($this->m_phone1)) {
			 $this->m_phone1 = trim($this->m_phone1);
		}
		if (isset($this->m_phone2)) {
			 $this->m_phone2 = trim($this->m_phone2);
		}
		if (isset($this->q_phone1)) {
			 $this->q_phone1 = trim($this->q_phone1);
		}
		if (isset($this->q_phone2)) {
			 $this->q_phone2 = trim($this->q_phone2);
		}
		if (isset($this->primary_phone)) {
			 $this->primary_phone = trim($this->primary_phone);
		}
		if (isset($this->temperature)) {
			 $this->temperature = trim($this->temperature);
		}

		

		// Check parameters
		// Put here code to add a control on parameters values

		// Update request
		$sql = 'UPDATE ' . MAIN_DB_PREFIX . $this->table_element . ' SET';
		
		$sql .= ' ref = "'.(isset($this->ref)?$this->ref:"null").'",';
		$sql .= ' fax = '.(isset($this->fax)?$this->ref:"null").',';
		
		$sql .= ' fk_member = '.(isset($this->fk_member)?$this->fk_member:"null").',';
		$sql .= ' id_provider = '.(isset($this->id_provider)?$this->id_provider:"null").',';
		$sql .= ' home_phone = '.(isset($this->home_phone)?"'".$this->db->escape($this->home_phone)."'":"null").',';
		$sql .= ' m_phone1 = '.(isset($this->m_phone1)?"'".$this->db->escape($this->m_phone1)."'":"null").',';
		$sql .= ' m_phone2 = '.(isset($this->m_phone2)?"'".$this->db->escape($this->m_phone2)."'":"null").',';
		$sql .= ' q_phone1 = '.(isset($this->q_phone1)?"'".$this->q_phone1."'":"null").',';
		$sql .= ' q_phone2 = '.(isset($this->q_phone1)?"'".$this->q_phone2."'":"null").',';
		$sql .= ' primary_phone = '.(isset($this->primary_phone)?$this->primary_phone:"null").',';
		$sql .= ' temperature = '.(isset($this->temperature)?$this->temperature:"null");

        
		$sql .= ' WHERE rowid=' . $this->id;

		$this->db->begin();

		$resql = $this->db->query($sql);
		if (!$resql) {
			$error ++;
			$this->errors[] = 'Error ' . $this->db->lasterror();
			dol_syslog(__METHOD__ . ' ' . join(',', $this->errors), LOG_ERR);
		}

		if (!$error && !$notrigger) {
			// Uncomment this and change MYOBJECT to your own tag if you
			// want this action calls a trigger.

			//// Call triggers
			//$result=$this->call_trigger('MYOBJECT_MODIFY',$user);
			//if ($result < 0) { $error++; //Do also what you must do to rollback action if trigger fail}
			//// End call triggers
		}

		// Commit or rollback
		if ($error) {
			$this->db->rollback();

			return - 1 * $error;
		} else {
			$this->db->commit();

			return 1;
		}
	}

	/**
	 * Delete object in database
	 *
	 * @param User $user      User that deletes
	 * @param bool $notrigger false=launch triggers after, true=disable triggers
	 *
	 * @return int <0 if KO, >0 if OK
	 */
	public function delete(User $user, $notrigger = false)
	{
		dol_syslog(__METHOD__, LOG_DEBUG);

		$error = 0;

		$this->db->begin();

		if (!$error) {
			if (!$notrigger) {
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action calls a trigger.

				//// Call triggers
				//$result=$this->call_trigger('MYOBJECT_DELETE',$user);
				//if ($result < 0) { $error++; //Do also what you must do to rollback action if trigger fail}
				//// End call triggers
			}
		}

		if (!$error) {
			$sql = 'DELETE FROM ' . MAIN_DB_PREFIX . $this->table_element;
			$sql .= ' WHERE rowid=' . $this->id;

			$resql = $this->db->query($sql);
			if (!$resql) {
				$error ++;
				$this->errors[] = 'Error ' . $this->db->lasterror();
				dol_syslog(__METHOD__ . ' ' . join(',', $this->errors), LOG_ERR);
			}
		}

		// Commit or rollback
		if ($error) {
			$this->db->rollback();

			return - 1 * $error;
		} else {
			$this->db->commit();

			return 1;
		}
	}

	/**
	 * Load an object from its id and create a new one in database
	 *
	 * @param int $fromid Id of object to clone
	 *
	 * @return int New id of clone
	 */
	public function createFromClone($fromid)
	{
		dol_syslog(__METHOD__, LOG_DEBUG);

		global $user;
		$error = 0;
		$object = new Mccomplements($this->db);

		$this->db->begin();

		// Load source object
		$object->fetch($fromid);
		// Reset object
		$object->id = 0;

		// Clear fields
		// ...

		// Create clone
		$result = $object->create($user);

		// Other options
		if ($result < 0) {
			$error ++;
			$this->errors = $object->errors;
			dol_syslog(__METHOD__ . ' ' . join(',', $this->errors), LOG_ERR);
		}

		// End
		if (!$error) {
			$this->db->commit();

			return $object->id;
		} else {
			$this->db->rollback();

			return - 1;
		}
	}

	/**
	 *  Return a link to the user card (with optionaly the picto)
	 * 	Use this->id,this->lastname, this->firstname
	 *
	 *	@param	int		$withpicto			Include picto in link (0=No picto, 1=Include picto into link, 2=Only picto)
	 *	@param	string	$option				On what the link point to
     *  @param	integer	$notooltip			1=Disable tooltip
     *  @param	int		$maxlen				Max length of visible user name
     *  @param  string  $morecss            Add more css on link
	 *	@return	string						String with URL
	 */
	function getNomUrl($withpicto=0, $option='', $notooltip=0, $maxlen=24, $morecss='')
	{
		global $langs, $conf, $db;
        global $dolibarr_main_authentication, $dolibarr_main_demo;
        global $menumanager;


        $result = '';
        $companylink = '';

        $label = '<u>' . $langs->trans("MyModule") . '</u>';
        $label.= '<div width="100%">';
        $label.= '<b>' . $langs->trans('Ref') . ':</b> ' . $this->ref;

        $link = '<a href="'.DOL_URL_ROOT.'/membercomplements/card.php?id='.$this->id.'"';
        $link.= ($notooltip?'':' title="'.dol_escape_htmltag($label, 1).'" class="classfortooltip'.($morecss?' '.$morecss:'').'"');
        $link.= '>';
		$linkend='</a>';

        if ($withpicto)
        {
            $result.=($link.img_object(($notooltip?'':$label), 'label', ($notooltip?'':'class="classfortooltip"')).$linkend);
            if ($withpicto != 2) $result.=' ';
		}
		$result.= $link . $this->ref . $linkend;
		return $result;
	}
	
	/**
	 *  Retourne le libelle du status d'un user (actif, inactif)
	 *
	 *  @param	int		$mode          0=libelle long, 1=libelle court, 2=Picto + Libelle court, 3=Picto, 4=Picto + Libelle long, 5=Libelle court + Picto
	 *  @return	string 			       Label of status
	 */
	function getLibStatut($mode=0)
	{
		return $this->LibStatut($this->status,$mode);
	}

	/**
	 *  Renvoi le libelle d'un status donne
	 *
	 *  @param	int		$status        	Id status
	 *  @param  int		$mode          	0=libelle long, 1=libelle court, 2=Picto + Libelle court, 3=Picto, 4=Picto + Libelle long, 5=Libelle court + Picto
	 *  @return string 			       	Label of status
	 */
	function LibStatut($status,$mode=0)
	{
		global $langs;

		if ($mode == 0)
		{
			$prefix='';
			if ($status == 1) return $langs->trans('Enabled');
			if ($status == 0) return $langs->trans('Disabled');
		}
		if ($mode == 1)
		{
			if ($status == 1) return $langs->trans('Enabled');
			if ($status == 0) return $langs->trans('Disabled');
		}
		if ($mode == 2)
		{
			if ($status == 1) return img_picto($langs->trans('Enabled'),'statut4').' '.$langs->trans('Enabled');
			if ($status == 0) return img_picto($langs->trans('Disabled'),'statut5').' '.$langs->trans('Disabled');
		}
		if ($mode == 3)
		{
			if ($status == 1) return img_picto($langs->trans('Enabled'),'statut4');
			if ($status == 0) return img_picto($langs->trans('Disabled'),'statut5');
		}
		if ($mode == 4)
		{
			if ($status == 1) return img_picto($langs->trans('Enabled'),'statut4').' '.$langs->trans('Enabled');
			if ($status == 0) return img_picto($langs->trans('Disabled'),'statut5').' '.$langs->trans('Disabled');
		}
		if ($mode == 5)
		{
			if ($status == 1) return $langs->trans('Enabled').' '.img_picto($langs->trans('Enabled'),'statut4');
			if ($status == 0) return $langs->trans('Disabled').' '.img_picto($langs->trans('Disabled'),'statut5');
		}
	}
	
	
	/**
	 * Initialise object with example values
	 * Id must be 0 if object instance is a specimen
	 *
	 * @return void
	 */
	public function initAsSpecimen()
	{
		$this->id = 0;
		
		$this->id_provider = '';
		$this->home_phone = '';
		$this->m_phone1 = '';
		$this->m_phone2 = '';
		$this->primary_phone = '';
		$this->temperature = '';

		
	}

}

/**
 * Class MccomplementsLine
 */
class MccomplementsLine
{
	/**
	 * @var int ID
	 */
	public $id;
	/**
	 * @var mixed Sample line property 1
	 */
	
	public $id_provider;
	public $home_phone;
	public $m_phone1;
	public $m_phone2;
	public $primary_phone;
	public $temperature;

	/**
	 * @var mixed Sample line property 2
	 */
	
}
