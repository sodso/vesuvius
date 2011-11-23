<?
/** ******************************************************************************************************************************************************************
*********************************************************************************************************************************************************************
********************************************************************************************************************************************************************
*
* @class        person
* @version      11
* @author       Greg Miernicki <g@miernicki.com>
*
********************************************************************************************************************************************************************
*********************************************************************************************************************************************************************
**********************************************************************************************************************************************************************/

class person {

	// holds the XML/format if used to instantiate in this manner
	public $theString; // object is initialized as a string first, then parsed into an array
	public $xmlFormat; // enumerated constant denoting type of the XML being loaded ~ REUNITE, TRIAGEPIC
	public $a; // holds the array of the parsed xml

	// table person_uuid
	public $p_uuid;
	public $full_name;
	public $family_name;
	public $given_name;
	public $incident_id;
	public $hospital_uuid;
	public $expiry_date;
	// original values (initialized at load and checked against when saved)
	private $Op_uuid;
	private $Ofull_name;
	private $Ofamily_name;
	private $Ogiven_name;
	private $Oincident_id;
	private $Ohospital_uuid;
	private $Oexpiry_date;

	// table person_status
	public $opt_status;
	public $last_updated;
	public $creation_time;
	// original values (initialized at load and checked against when saved)
	private $Oopt_status;
	private $Olast_updated;
	private $Ocreation_time;

	// table person_details
	public $birth_date;
	public $opt_race;
	public $opt_religion;
	public $opt_gender;
	public $years_old;
	public $minAge;
	public $maxAge;
	public $last_seen;
	public $last_clothing;
	public $other_comments;
	// original values (initialized at load and checked against when saved)
	private $Obirth_date;
	private $Oopt_race;
	private $Oopt_religion;
	private $Oopt_gender;
	private $Oyears_old;
	private $OminAge;
	private $OmaxAge;
	private $Olast_seen;
	private $Olast_clothing;
	private $Oother_comments;

	// table person_to_report
	public $rep_uuid;
	// original values (initialized at load and checked against when saved)
	private $Orep_uuid;

	// person's images
	public $images;

	// person's edxl components
	public $edxl;

	// person's voice_note
	public $voice_note;

	// sql strings of the objetct's attributes
	private $sql_p_uuid;
	private $sql_full_name;
	private $sql_family_name;
	private $sql_given_name;
	private $sql_incident_id;
	private $sql_hospital_uuid;
	private $sql_expiry_date;
	private $sql_opt_status;
	private $sql_last_updated;
	private $sql_creation_time;
	private $sql_birth_date;
	private $sql_opt_race;
	private $sql_opt_religion;
	private $sql_opt_gender;
	private $sql_years_old;
	private $sql_minAge;
	private $sql_maxAge;
	private $sql_last_seen;
	private $sql_last_clothing;
	private $sql_other_comments;
	private $sql_rep_uuid;
	// and for original values..
	private $sql_Op_uuid;
	private $sql_Ofull_name;
	private $sql_Ofamily_name;
	private $sql_Ogiven_name;
	private $sql_Oincident_id;
	private $sql_Ohospital_uuid;
	private $sql_Oexpiry_date;
	private $sql_Oopt_status;
	private $sql_Olast_updated;
	private $sql_Ocreation_time;
	private $sql_Obirth_date;
	private $sql_Oopt_race;
	private $sql_Oopt_religion;
	private $sql_Oopt_gender;
	private $sql_Oyears_old;
	private $sql_OminAge;
	private $sql_OmaxAge;
	private $sql_Olast_seen;
	private $sql_Olast_clothing;
	private $sql_Oother_comments;
	private $sql_Orep_uuid;

	// used for when we recieve emails from mpres to make a pfif_note
	public $author_name;
	public $author_email;

	// whether to make a static PFIF not upon insertion
	public $makePfifNote;

	// if we encounter an error anywhere along the way, its value will be stored here ~ no error, value = 0
	public $ecode;

	// we hold the p_uuid of the person making modifications to the record
	public $updated_by_p_uuid;

	// boolean values to denote the origin of the person (for statistical purposes)
	public $arrival_triagepic;
	public $arrival_reunite;
	public $arrival_website;
	public $arrival_pfif;
	public $arrival_vanilla_email;

	// Constructor:
	public function	__construct() {
		// init db
		global $global;
		$this->db = $global['db'];

		$this->theString      = null;
		$this->xmlFormat      = null;
		$this->a              = null;

		$this->p_uuid         = null;
		$this->full_name      = null;
		$this->family_name    = null;
		$this->given_name     = null;
		$this->incident_id    = null;
		$this->hospital_uuid  = null;
		$this->expiry_date    = null;
		$this->opt_status     = null;
		$this->last_updated   = null;
		$this->creation_time  = null;
		$this->birth_date     = null;
		$this->opt_race       = null;
		$this->opt_religion   = null;
		$this->opt_gender     = null;
		$this->years_old      = null;
		$this->minAge         = null;
		$this->maxAge         = null;
		$this->last_seen      = null;
		$this->last_clothing  = null;
		$this->other_comments = null;
		$this->rep_uuid       = null;

		$this->Op_uuid         = null;
		$this->Ofull_name      = null;
		$this->Ofamily_name    = null;
		$this->Ogiven_name     = null;
		$this->Oincident_id    = null;
		$this->Ohospital_uuid  = null;
		$this->Oexpiry_date    = null;
		$this->Oopt_status     = null;
		$this->Olast_updated   = null;
		$this->Ocreation_time  = null;
		$this->Obirth_date     = null;
		$this->Oopt_race       = null;
		$this->Oopt_religion   = null;
		$this->Oopt_gender     = null;
		$this->Oyears_old      = null;
		$this->OminAge         = null;
		$this->OmaxAge         = null;
		$this->Olast_seen      = null;
		$this->Olast_clothing  = null;
		$this->Oother_comments = null;
		$this->Orep_uuid       = null;

		$this->images         = array();
		$this->edxl           = null;
		$this->voice_note     = null;

		$this->sql_p_uuid         = null;
		$this->sql_full_name      = null;
		$this->sql_family_name    = null;
		$this->sql_given_name     = null;
		$this->sql_incident_id    = null;
		$this->sql_hospital_uuid  = null;
		$this->sql_expiry_date    = null;
		$this->sql_opt_status     = null;
		$this->sql_last_updated   = null;
		$this->sql_creation_time  = null;
		$this->sql_birth_date     = null;
		$this->sql_opt_race       = null;
		$this->sql_opt_religion   = null;
		$this->sql_opt_gender     = null;
		$this->sql_years_old      = null;
		$this->sql_minAge         = null;
		$this->sql_maxAge         = null;
		$this->sql_last_seen      = null;
		$this->sql_last_clothing  = null;
		$this->sql_other_comments = null;
		$this->sql_rep_uuid       = null;

		$this->sql_Op_uuid         = null;
		$this->sql_Ofull_name      = null;
		$this->sql_Ofamily_name    = null;
		$this->sql_Ogiven_name     = null;
		$this->sql_Oincident_id    = null;
		$this->sql_Ohospital_uuid  = null;
		$this->sql_Oexpiry_date    = null;
		$this->sql_Oopt_status     = null;
		$this->sql_Olast_updated   = null;
		$this->sql_Ocreation_time  = null;
		$this->sql_Obirth_date     = null;
		$this->sql_Oopt_race       = null;
		$this->sql_Oopt_religion   = null;
		$this->sql_Oopt_gender     = null;
		$this->sql_Oyears_old      = null;
		$this->sql_OminAge         = null;
		$this->sql_OmaxAge         = null;
		$this->sql_Olast_seen      = null;
		$this->sql_Olast_clothing  = null;
		$this->sql_Oother_comments = null;
		$this->sql_Orep_uuid       = null;

		$this->author_name         = null;
		$this->author_email        = null;

		$this->makePfifNote        = true;

		$this->ecode = 0;

		$this->updated_by_p_uuid   = null;

		$this->arrival_triagepic     = false;
		$this->arrival_reunite       = false;
		$this->arrival_website       = false;
		$this->arrival_pfif          = false;
		$this->arrival_vanilla_email = false;
	}



	// Destructor
	public function __destruct() {
		$this->theString      = null;
		$this->xmlFormat      = null;
		$this->a              = null;

		$this->p_uuid         = null;
		$this->full_name      = null;
		$this->family_name    = null;
		$this->given_name     = null;
		$this->incident_id    = null;
		$this->hospital_uuid  = null;
		$this->expiry_date    = null;
		$this->opt_status     = null;
		$this->last_updated   = null;
		$this->creation_time  = null;
		$this->birth_date     = null;
		$this->opt_race       = null;
		$this->opt_religion   = null;
		$this->opt_gender     = null;
		$this->years_old      = null;
		$this->minAge         = null;
		$this->maxAge         = null;
		$this->last_seen      = null;
		$this->last_clothing  = null;
		$this->other_comments = null;
		$this->rep_uuid       = null;

		$this->Op_uuid         = null;
		$this->Ofull_name      = null;
		$this->Ofamily_name    = null;
		$this->Ogiven_name     = null;
		$this->Oincident_id    = null;
		$this->Ohospital_uuid  = null;
		$this->Oexpiry_date    = null;
		$this->Oopt_status     = null;
		$this->Olast_updated   = null;
		$this->Ocreation_time  = null;
		$this->Obirth_date     = null;
		$this->Oopt_race       = null;
		$this->Oopt_religion   = null;
		$this->Oopt_gender     = null;
		$this->Oyears_old      = null;
		$this->OminAge         = null;
		$this->OmaxAge         = null;
		$this->Olast_seen      = null;
		$this->Olast_clothing  = null;
		$this->Oother_comments = null;
		$this->Orep_uuid       = null;

		$this->images          = null;
		$this->edxl            = null;
		$this->voice_note      = null;

		$this->sql_p_uuid         = null;
		$this->sql_full_name      = null;
		$this->sql_family_name    = null;
		$this->sql_given_name     = null;
		$this->sql_incident_id    = null;
		$this->sql_hospital_uuid  = null;
		$this->sql_expiry_date    = null;
		$this->sql_opt_status     = null;
		$this->sql_last_updated   = null;
		$this->sql_creation_time  = null;
		$this->sql_birth_date     = null;
		$this->sql_opt_race       = null;
		$this->sql_opt_religion   = null;
		$this->sql_opt_gender     = null;
		$this->sql_years_old      = null;
		$this->sql_minAge         = null;
		$this->sql_maxAge         = null;
		$this->sql_last_seen      = null;
		$this->sql_last_clothing  = null;
		$this->sql_other_comments = null;
		$this->sql_rep_uuid       = null;

		$this->sql_Op_uuid         = null;
		$this->sql_Ofull_name      = null;
		$this->sql_Ofamily_name    = null;
		$this->sql_Ogiven_name     = null;
		$this->sql_Oincident_id    = null;
		$this->sql_Ohospital_uuid  = null;
		$this->sql_Oexpiry_date    = null;
		$this->sql_Oopt_status     = null;
		$this->sql_Olast_updated   = null;
		$this->sql_Ocreation_time  = null;
		$this->sql_Obirth_date     = null;
		$this->sql_Oopt_race       = null;
		$this->sql_Oopt_religion   = null;
		$this->sql_Oopt_gender     = null;
		$this->sql_Oyears_old      = null;
		$this->sql_OminAge         = null;
		$this->sql_OmaxAge         = null;
		$this->sql_Olast_seen      = null;
		$this->sql_Olast_clothing  = null;
		$this->sql_Oother_comments = null;
		$this->sql_Orep_uuid       = null;

		$this->author_name         = null;
		$this->author_email        = null;

		$this->makePfifNote        = null;

		$this->ecode               = null;

		$this->updated_by_p_uuid   = null;

		$this->arrival_triagepic     = null;
		$this->arrival_reunite       = null;
		$this->arrival_website       = null;
		$this->arrival_pfif          = null;
		$this->arrival_vanilla_email = null;
	}


	// initializes..
	public function init() {
		global $global;
		// not to do yet...
	}


	// loads the data from a person in the database
	public function load() {
		global $global;

		$q = "
			SELECT *
			FROM person_uuid
			WHERE p_uuid = '".mysql_real_escape_string((string)$this->p_uuid)."' ;
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person load person_uuid ((".$q."))"); }

		if($result != NULL && !$result->EOF) {
			$this->full_name     = $result->fields['full_name'];
			$this->family_name   = $result->fields['family_name'];
			$this->given_name    = $result->fields['given_name'];
			$this->incident_id   = $result->fields['incident_id'];
			$this->hospital_uuid = $result->fields['hospital_uuid'];
			$this->expiry_date   = $result->fields['expiry_date'];

			// save them as original values too...
			$this->Ofull_name     = $result->fields['full_name'];
			$this->Ofamily_name   = $result->fields['family_name'];
			$this->Ogiven_name    = $result->fields['given_name'];
			$this->Oincident_id   = $result->fields['incident_id'];
			$this->Ohospital_uuid = $result->fields['hospital_uuid'];
			$this->Oexpiry_date   = $result->fields['expiry_date'];
		} else {
			$this->ecode = 9000;
		}


		$q = "
			SELECT *
			FROM person_status
			WHERE p_uuid = '".mysql_real_escape_string((string)$this->p_uuid)."' ;
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person load person_status ((".$q."))"); }

		if($result != NULL && !$result->EOF) {
			$this->opt_status    = $result->fields['opt_status'];
			$this->last_updated  = $result->fields['last_updated'];
			$this->creation_time = $result->fields['creation_time'];

			// save them as original values too...
			$this->Oopt_status    = $result->fields['opt_status'];
			$this->Olast_updated  = $result->fields['last_updated'];
			$this->Ocreation_time = $result->fields['creation_time'];
		} else {
			$this->ecode = 9000;
		}


		$q = "
			SELECT *
			FROM person_details
			WHERE p_uuid = '".mysql_real_escape_string((string)$this->p_uuid)."' ;
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person load person_details ((".$q."))"); }

		if($result != NULL && !$result->EOF) {
			$this->birth_date     = $result->fields['birth_date'];
			$this->opt_race       = $result->fields['opt_race'];
			$this->opt_religion   = $result->fields['opt_religion'];
			$this->opt_gender     = $result->fields['opt_gender'];
			$this->years_old      = $result->fields['years_old'];
			$this->minAge         = $result->fields['minAge'];
			$this->maxAge         = $result->fields['maxAge'];
			$this->last_seen      = $result->fields['last_seen'];
			$this->last_clothing  = $result->fields['last_clothing'];
			$this->other_comments = $result->fields['other_comments'];

			// save them as original values too...
			$this->Obirth_date     = $result->fields['birth_date'];
			$this->Oopt_race       = $result->fields['opt_race'];
			$this->Oopt_religion   = $result->fields['opt_religion'];
			$this->Oopt_gender     = $result->fields['opt_gender'];
			$this->Oyears_old      = $result->fields['years_old'];
			$this->OminAge         = $result->fields['minAge'];
			$this->OmaxAge         = $result->fields['maxAge'];
			$this->Olast_seen      = $result->fields['last_seen'];
			$this->Olast_clothing  = $result->fields['last_clothing'];
			$this->Oother_comments = $result->fields['other_comments'];
		} else {
			$this->ecode = 9000;
		}


		$q = "
			SELECT *
			FROM person_to_report
			WHERE p_uuid = '".mysql_real_escape_string((string)$this->p_uuid)."' ;
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person load person_to_report ((".$q."))"); }

		if($result != NULL && !$result->EOF) {
			$this->rep_uuid = $result->fields['rep_uuid'];
			// original value too...
			$this->Orep_uuid = $result->fields['rep_uuid'];
		} else {
			$this->ecode = 9000;
		}

		//$this->loadImages();
		//$this->loadEdxl();
		//$this->loadPfif();
		//$this->loadVoiceNote();
	}


	// synchronize SQL value strings with public attributes
	private function sync() {
		global $global;

		// map enum types

		if($this->opt_gender == "M") {
			$this->opt_gender = "mal";
		} elseif($this->opt_gender == "F") {
			$this->opt_gender = "fml";
		} elseif($this->opt_gender == "C") {
			$this->opt_gender = "cpx";
		} elseif($this->opt_gender == "U") {
			$this->opt_gender = null;
		} else {
			$this->opt_gender = null;
		}

		$this->full_name = $this->given_name." ".$this->family_name;
		if($this->given_name === null) {
			$this->full_name = $this->family_name;
		}
		if($this->family_name === null) {
			$this->full_name = $this->given_name;
		}
		if($this->given_name === null && $this->family_name === null) {
			$this->full_name = null;
		}

		// build SQL value strings
		$this->sql_p_uuid         = ($this->p_uuid         === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->p_uuid)."'";
		$this->sql_full_name      = ($this->full_name      === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->full_name)."'";
		$this->sql_family_name    = ($this->family_name    === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->family_name)."'";
		$this->sql_given_name     = ($this->given_name     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->given_name)."'";
		$this->sql_incident_id    = ($this->incident_id    === null) ? "NULL" : (int)$this->incident_id;
		$this->sql_hospital_uuid  = ($this->hospital_uuid  === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->hospital_uuid)."'";
		$this->sql_expiry_date    = ($this->expiry_date    === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->expiry_date)."'";

		$this->sql_opt_status     = ($this->opt_status     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->opt_status)."'";
		$this->sql_last_updated   = ($this->last_updated   === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->last_updated)."'";
		$this->sql_creation_time  = ($this->creation_time  === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->creation_time)."'";

		$this->sql_birth_date     = ($this->birth_date     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->birth_date)."'";
		$this->sql_opt_race       = ($this->opt_race       === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->opt_race)."'";
		$this->sql_opt_religion   = ($this->opt_religion   === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->opt_religion)."'";
		$this->sql_opt_gender     = ($this->opt_gender     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->opt_gender)."'";
		$this->sql_years_old      = ($this->years_old      === null) ? "NULL" : (int)$this->years_old;
		$this->sql_minAge         = ($this->minAge         === null) ? "NULL" : (int)$this->minAge;
		$this->sql_maxAge         = ($this->maxAge         === null) ? "NULL" : (int)$this->maxAge;
		$this->sql_last_seen      = ($this->last_seen      === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->last_seen)."'";
		$this->sql_last_clothing  = ($this->last_clothing  === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->last_clothing)."'";
		$this->sql_other_comments = ($this->other_comments === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->other_comments)."'";

		$this->sql_rep_uuid       = ($this->rep_uuid       === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->rep_uuid)."'";

		// do the same for original values...
		$this->sql_Op_uuid         = ($this->Op_uuid         === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Op_uuid)."'";
		$this->sql_Ofull_name      = ($this->Ofull_name      === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Ofull_name)."'";
		$this->sql_Ofamily_name    = ($this->Ofamily_name    === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Ofamily_name)."'";
		$this->sql_Ogiven_name     = ($this->Ogiven_name     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Ogiven_name)."'";
		$this->sql_Oincident_id    = ($this->Oincident_id    === null) ? "NULL" : (int)$this->Oincident_id;
		$this->sql_Ohospital_uuid  = ($this->Ohospital_uuid  === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Ohospital_uuid)."'";
		$this->sql_Oexpiry_date    = ($this->Oexpiry_date    === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Oexpiry_date)."'";

		$this->sql_Oopt_status     = ($this->Oopt_status     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Oopt_status)."'";
		$this->sql_Olast_updated   = ($this->Olast_updated   === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Olast_updated)."'";
		$this->sql_Ocreation_time  = ($this->Ocreation_time  === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Ocreation_time)."'";

		$this->sql_Obirth_date     = ($this->Obirth_date     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Obirth_date)."'";
		$this->sql_Oopt_race       = ($this->Oopt_race       === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Oopt_race)."'";
		$this->sql_Oopt_religion   = ($this->Oopt_religion   === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Oopt_religion)."'";
		$this->sql_Oopt_gender     = ($this->Oopt_gender     === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Oopt_gender)."'";
		$this->sql_Oyears_old      = ($this->Oyears_old      === null) ? "NULL" : (int)$this->Oyears_old;
		$this->sql_OminAge         = ($this->OminAge         === null) ? "NULL" : (int)$this->OminAge;
		$this->sql_OmaxAge         = ($this->OmaxAge         === null) ? "NULL" : (int)$this->OmaxAge;
		$this->sql_Olast_seen      = ($this->Olast_seen      === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Olast_seen)."'";
		$this->sql_Olast_clothing  = ($this->Olast_clothing  === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Olast_clothing)."'";
		$this->sql_Oother_comments = ($this->Oother_comments === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Oother_comments)."'";

		$this->sql_Orep_uuid       = ($this->Orep_uuid       === null) ? "NULL" : "'".mysql_real_escape_string((string)$this->Orep_uuid)."'";
	}


	// save the person (initial save = insert)
	public function insert() {
		$this->sync();
		$q = "
			INSERT INTO person_uuid (
				p_uuid,
				full_name,
				family_name,
				given_name,
				incident_id,
				hospital_uuid,
				expiry_date )
			VALUES (
				".$this->sql_p_uuid.",
				".$this->sql_full_name.",
				".$this->sql_family_name.",
				".$this->sql_given_name.",
				".$this->sql_incident_id.",
				".$this->sql_hospital_uuid.",
				".$this->sql_expiry_date." );
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_uuid insert ((".$q."))"); }

		$q = "
			INSERT INTO person_status (
				p_uuid,
				opt_status,
				last_updated,
				creation_time )
			VALUES (
				".$this->sql_p_uuid.",
				".$this->sql_opt_status.",
				".$this->sql_last_updated.",
				".$this->sql_creation_time." );
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_status insert ((".$q."))"); }

		$q = "
			INSERT INTO person_details (
				p_uuid,
				birth_date,
				opt_race,
				opt_religion,
				opt_gender,
				years_old,
				minAge,
				maxAge,
				last_seen,
				last_clothing,
				other_comments )
			VALUES (
				".$this->sql_p_uuid.",
				".$this->sql_birth_date.",
				".$this->sql_opt_race.",
				".$this->sql_opt_religion.",
				".$this->sql_opt_gender.",
				".$this->sql_years_old.",
				".$this->sql_minAge.",
				".$this->sql_maxAge.",
				".$this->sql_last_seen.",
				".$this->sql_last_clothing.",
				".$this->sql_other_comments." );
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_details insert ((".$q."))"); }

		$q = "
			INSERT INTO  `person_to_report` (`p_uuid`, `rep_uuid`)
			VALUES (".$this->sql_p_uuid.", ".$this->sql_rep_uuid.");
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_to_report insert ((".$q."))"); }

		$this->insertImages();
		$this->insertEdxl();
		$this->makeStaticPfifNote();
		$this->insertVoiceNote();

		// keep arrival rate Statistics...
		updateArrivalRate($this->person_uuid, $this->incident_id, $this->arrival_triagepic, $this->arrival_reunite, $this->arrival_website, $this->arrival_pfif, $this->arrival_vanilla_email);
	}


	// save the person (subsequent save = update)
	public function update() {
		$this->sync();
		$this->saveRevisions();

		$q = "
			UPDATE person_uuid
			SET
				full_name     = ".$this->sql_full_name.",
				family_name   = ".$this->sql_family_name.",
				given_name    = ".$this->sql_given_name.",
				incident_id   = ".$this->sql_incident_id.",
				hospital_uuid = ".$this->sql_hospital_uuid.",
				expiry_date   = ".$this->sql_expiry_date."
			WHERE p_uuid = ".$this->sql_p_uuid.";
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_uuid update ((".$q."))"); }

		// we always update the last_updated to current time when saving(updating)
		$q = "
			UPDATE person_status
			SET
				opt_status    = ".$this->sql_opt_status.",
				last_updated  = '".date('Y-m-d H:i:s')."',
				creation_time = ".$this->sql_creation_time."
			WHERE p_uuid = ".$this->sql_p_uuid.";
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_status update ((".$q."))"); }

		$q = "
			UPDATE person_details
			SET
				birth_date     = ".$this->sql_birth_date.",
				opt_race       = ".$this->sql_opt_race.",
				opt_religion   = ".$this->sql_opt_religion.",
				opt_gender     = ".$this->sql_opt_gender.",
				years_old      = ".$this->sql_years_old.",
				minAge         = ".$this->sql_minAge.",
				maxAge         = ".$this->sql_maxAge.",
				last_seen      = ".$this->sql_last_seen.",
				last_clothing  = ".$this->sql_last_clothing.",
				other_comments = ".$this->sql_other_comments."
			WHERE p_uuid = ".$this->sql_p_uuid.";
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_details update ((".$q."))"); }


		$q = "
			UPDATE person_to_report
			SET
				rep_uuid = ".$this->sql_rep_uuid."
			WHERE p_uuid = ".$this->sql_p_uuid.";
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person person_to_report update ((".$q."))"); }

		//$this->updateImages();
		//$this->updateEdxl();
		//$this->updateVoiceNote();
	}


	// save any changes since object was loaded as revisions
	function saveRevisions() {
		global $global;
		global $revisionCount;

		if($this->full_name      != $this->Ofull_name)      { $this->saveRevision($this->sql_full_name,      $this->sql_Ofull_name,      'person_uuid',      'full_name'     ); }
		if($this->family_name    != $this->Ofamily_name)    { $this->saveRevision($this->sql_family_name,    $this->sql_Ofamily_name,    'person_uuid',      'family_name'   ); }
		if($this->given_name     != $this->Ogiven_name)     { $this->saveRevision($this->sql_given_name,     $this->sql_Ogiven_name,     'person_uuid',      'given_name'    ); }
		if($this->incident_id    != $this->Oincident_id)    { $this->saveRevision($this->sql_incident_id,    $this->sql_Oincident_id,    'person_uuid',      'incident_id'   ); }
		if($this->hospital_uuid  != $this->Ohospital_uuid)  { $this->saveRevision($this->sql_hospital_uuid,  $this->sql_Ohospital_uuid,  'person_uuid',      'hospital_uuid' ); }
		if($this->expiry_date    != $this->Oexpiry_date)    { $this->saveRevision($this->sql_expiry_date,    $this->sql_Oexpiry_date,    'person_uuid',      'expiry_date'   ); }
		if($this->opt_status     != $this->Oopt_status)     { $this->saveRevision($this->sql_opt_status,     $this->sql_Oopt_status,     'person_status',    'opt_status'    ); }
		if($this->last_updated   != $this->Olast_updated)   { $this->saveRevision($this->sql_last_updated,   $this->sql_Olast_updated,   'person_status',    'last_updated'  ); }
		if($this->creation_time  != $this->Ocreation_time)  { $this->saveRevision($this->sql_creation_time,  $this->sql_Ocreation_time,  'person_status',    'creation_time' ); }
		if($this->birth_date     != $this->Obirth_date)     { $this->saveRevision($this->sql_birth_date,     $this->sql_Obirth_date,     'person_details',   'birth_date'    ); }
		if($this->opt_race       != $this->Oopt_race)       { $this->saveRevision($this->sql_opt_race,       $this->sql_Oopt_race,       'person_details',   'opt_race'      ); }
		if($this->opt_religion   != $this->Oopt_religion)   { $this->saveRevision($this->sql_opt_religion,   $this->sql_Oopt_religion,   'person_details',   'opt_religion'  ); }
		if($this->opt_gender     != $this->Oopt_gender)     { $this->saveRevision($this->sql_opt_gender,     $this->sql_Oopt_gender,     'person_details',   'opt_gender'    ); }
		if($this->years_old      != $this->Oyears_old)      { $this->saveRevision($this->sql_years_old,      $this->sql_Oyears_old,      'person_details',   'years_old'     ); }
		if($this->minAge         != $this->OminAge)         { $this->saveRevision($this->sql_minAge,         $this->sql_OminAge,         'person_details',   'minAge'        ); }
		if($this->maxAge         != $this->OmaxAge)         { $this->saveRevision($this->sql_maxAge,         $this->sql_OmaxAge,         'person_details',   'maxAge'        ); }
		if($this->last_seen      != $this->Olast_seen)      { $this->saveRevision($this->sql_last_seen,      $this->sql_Olast_seen,      'person_details',   'last_seen'     ); }
		if($this->last_clothing  != $this->Olast_clothing)  { $this->saveRevision($this->sql_last_clothing,  $this->sql_Olast_clothing,  'person_details',   'last_clothing' ); }
		if($this->other_comments != $this->Oother_comments) { $this->saveRevision($this->sql_other_comments, $this->sql_Oother_comments, 'person_details',   'other_comments'); }
		if($this->rep_uuid       != $this->Orep_uuid)       { $this->saveRevision($this->sql_rep_uuid,       $this->sql_Orep_uuid,       'person_to_report', 'rep_uuid'      ); }
	}


	// save the revision
	function saveRevision($newValue, $oldValue, $table, $column) {
		// note the revision
		$q = "
			INSERT into person_updates (`p_uuid`, `updated_table`, `updated_column`, `old_value`, `new_value`, `updated_by_p_uuid`)
			VALUES (".$this->sql_p_uuid.", '".$table."', '".$column."', ".$oldValue.", ".$newValue.", '".$this->updated_by_p_uuid."');
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person saveRevision ((".$q."))"); }
	}


	// expires a person...
	function expire($user_id, $explanation) {

		// set the expiration time to now
		$this->expiry_date = date('Y-m-d H:i:s');
		$this->update();

		// first we clear out all pending expiration requests...
		$q = "
			DELETE FROM expiry_queue
			WHERE p_uuid = ".$this->sql_p_uuid.";
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person expire 1 ((".$q."))"); }

		// next we insert a row to indicate who expired this person record
		$q = "
			INSERT into expiry_queue (`p_uuid`, `requested_by_user_id`, `requested_when`, `queued`, `approved_by_user_id`, `approved_when`, `approved_why`, `expired`)
			VALUES (".$this->sql_p_uuid.", NULL, NULL, 0, '".$user_id."', ".$this->sql_expiry_date.", '".mysql_real_escape_string($explanation)."', 1);
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person expire 2 ((".$q."))"); }
	}


	// queues the expiration of a person
	function expireQueue($user_id, $explanation) {
		$this->sync();
		$q = "
			INSERT into expiry_queue (`p_uuid`, `requested_by_user_id`, `requested_when`, `requested_why`, `queued`, `approved_by_user_id`, `approved_when`, `expired`)
			VALUES (".$this->sql_p_uuid.", '".$user_id."', '".date('Y-m-d H:i:s')."', '".mysql_real_escape_string($explanation)."', 1, NULL, NULL, 0);
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person expireQueue ((".$q."))"); }
	}


	// updates a expiry_date
	function setExpiryDate($expiryDate) {

		$this->expiry_date = $expiryDate;
		$this->update();
	}


	// updates a expiry_date to one year from now
	function setExpiryDateOneYear() {

		$this->expiry_date = date('Y-m-d H:i:s', time()+(60*60*24*365));
		$this->update();
	}


	// checks if the person record has already expired (expiry_date is in the past)
	function isAlreadyExpired() {

		$currentTime = date('Y-m-d H:i:s');

		$d1 = new DateTime($this->expiry_date);
		$d2 = new DateTime($currentTime);

		if($this->expiry_date === null) {
			return false;
		} else if($d1 == $d2 || $d1 < $d2) {
			return true;
		} else if($d1 > $d2) {
			return false;
		}
	}


	// sets a new massCasualtyId on a person... HACK!!!!!
	function setMassCasualtyId($newMcid) {

		// we must revise this to work once DAO load/update is completed on all objects!!!
		// HACK REMOVAL NOTICE !!! REMOVE THIS HACK SOMEDAY!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11111111111111

		$this->sync();

		$q = "
			UPDATE edxl_co_lpf
			SET person_id = '".mysql_real_escape_string($newMcid)."'
			WHERE p_uuid = ".$this->sql_p_uuid.";
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person setMassCasualtyId HACK 1 ((".$q."))"); }

		// note the revision
		$q = "
			INSERT into person_updates (`p_uuid`, `updated_table`, `updated_column`, `old_value`, `new_value`, `updated_by_p_uuid`)
			VALUES (".$this->sql_p_uuid.", 'edxl_co_lpf', 'person_id', 'NOT_YET_SET', '".mysql_real_escape_string($newMcid)."', '".$this->updated_by_p_uuid."');
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person setMassCasultyId HACK 2 ((".$q."))"); }
	}


	// insert into plus_log
	public function plusReportLog() {
		$q = "
			INSERT INTO plus_report_log (p_uuid, enum)
			VALUES ('".$this->p_uuid."', '".$this->xmlFormat."');
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person plus_report insert ((".$q."))"); }
	}


	// insert into rap_log
	public function rapReportLog() {
		$q = "
			INSERT INTO rap_log (p_uuid)
			VALUES ('".$this->p_uuid."');
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person rap_log insert ((".$q."))"); }
	}


	private function insertVoiceNote() {
		if($this->voice_note != null) {
			$this->voice_note->insert();
		}
	}


	private function insertEdxl() {
		if($this->edxl != null) {
			$this->edxl->insert();
		}
	}


	private function insertImages() {
		foreach($this->images as $image) {
			$image->insert();
		}
	}


	public function makeStaticPfifNote() {
		// make the note unless we are explicitly asked not to...
		if(!$this->makePfifNote) {
			return;
		}

		global $global;
		require_once($global['approot']."inc/lib_uuid.inc");
		require_once($global['approot']."mod/pfif/pfif.inc");
		require_once($global['approot']."mod/pfif/util.inc");

		$p = new Pfif();

		$n = new Pfif_Note();
		$n->note_record_id          = shn_create_uuid('pfif_note');
		$n->person_record_id        = $this->p_uuid;
		$n->linked_person_record_id = null;
		$n->source_date             = $this->last_updated; // since we are now creating the note,
		$n->entry_date              = $this->last_updated; // we use the last_updated for both values
		$n->author_phone            = null;
		$n->email_of_found_person   = null;
		$n->phone_of_found_person   = null;
		$n->last_known_location     = $this->last_seen;
		$n->text                    = $this->other_comments;
		$n->found                   = null; // we have no way to know if the reporter had direct contact (hence we leave this null)

		// figure out the person's pfif status
		$n->status = shn_map_status_to_pfif($this->opt_status);

		// find author name and email...
		$q = "
			SELECT *
			FROM contact c, person_uuid p
			WHERE p.p_uuid = c.p_uuid
			AND c.opt_contact_type = 'email'
			AND p.p_uuid = '".$this->rep_uuid."';
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person get contact for pfif note ((".$q."))"); }

		if($result != NULL && !$result->EOF) {
			$n->author_name  = $result->fields['full_name'];
			$n->author_email = $result->fields['contact_value'];
		} elseif($this->author_name != null) {
			$n->author_name  = $this->author_name;
			$n->author_email = $this->author_email;
		} else {
			$n->author_name  = null;
			$n->author_email = null;
		}

		$p->setNote($n);
		$p->setIncidentId($this->incident_id);
		$p->storeNotesInDatabase();
	}


	public function isEventOpen() {
		// find if this event is open/closed
		$q = "
			SELECT *
			FROM incident
			WHERE incident_id = '".$this->incident_id."';
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person check event open ((".$q."))"); }

		if($result != NULL && !$result->EOF) {
			$row = $result->FetchRow();
		} else {
			return false;
		}
		if($row['closed'] != 0) {
			return false;
		} else {
			return true;
		}
	}


	public function addImage($fileContentBase64, $filename) {
		// create sahana image
		if(trim($fileContentBase64) != "") {
			$i = new personImage();
			$i->init();
			$i->p_uuid = $this->p_uuid;
			$i->fileContentBase64 = $fileContentBase64;
			$i->original_filename = $filename;
			$this->images[] = $i;
		}
	}


	public function createUUID() {
		if($this->p_uuid === null || $this->p_uuid == "") {
			$this->p_uuid = shn_create_uuid("person");
		}
	}


	// set the event id (which will be ignored by XML parser)
	public function setEvent($eventShortName) {
		$q = "
			SELECT *
			FROM `incident`
			WHERE shortname = '".mysql_real_escape_string($eventShortName)."';
		";
		$result = $this->db->Execute($q);
		if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person get incident ((".$q."))"); }

		$this->incident_id = $result->fields['incident_id'];
	}


	public function parseXml() {
		global $global;
		require_once($global['approot']."inc/lib_uuid.inc");

		// save xml for debuggins?
		if($global['debugAndSaveXmlToFile'] == true) {
			$filename = "debugXML_".mt_rand();
			$path = $global['approot']."www/tmp/plus_cache/".$filename.".xml";
			file_put_contents($path, $this->theString);
		}

		// is this a supported XML type?
		if(!in_array((string)trim($this->xmlFormat), $global['enumXmlFormats'])) {
			return (int)400;
		}

		//$a = xml2array($this->theString);
		$aa = new XMLParser();
		$aa->rawXML = $this->theString;
		$aa->parse();

		if($aa->getError()) {
			return (int)403; // error code for failed to parse xml
		}

		$a = $aa->getArray();

		// parse REUNITE3 XML
		if($this->xmlFormat == "REUNITE3") {

			$this->arrival_reunite = true;
			$this->p_uuid         = $a['person']['p_uuid'];
			$this->given_name     = $a['person']['givenName'];
			$this->family_name    = $a['person']['familyName'];
			$this->expiry_date    = $a['person']['expiryDate'];
			$this->opt_status     = $a['person']['status'];
			$this->last_updated   = date('Y-m-d H:i:s');
			$this->creation_time  = $a['person']['dateTimeSent'];
			$this->opt_gender     = $a['person']['gender'];
			$this->years_old      = $a['person']['estimatedAge'];
			$this->minAge         = $a['person']['minAge'];
			$this->maxAge         = $a['person']['maxAge'];
			$this->other_comments = $a['person']['note'];

			// only update the incident_id if not already set
			if($this->incident_id === null) {
				$this->incident_id = $a['person']['eventId'];
			}

			foreach($a['person']['photos'] as $photo) {
				if(trim($photo['data']) != "") {
					$i = new personImage();
					$i->init();
					$i->p_uuid = $this->p_uuid;
					$i->fileContentBase64 = $photo['data'];
					foreach($photo['tags'] as $tag) {
						$t = new personImageTag();
						$t->init();
						$t->image_id = $i->image_id;
						$t->tag_x    = $tag['x'];
						$t->tag_y    = $tag['y'];
						$t->tag_w    = $tag['w'];
						$t->tag_h    = $tag['h'];
						$t->tag_text = $tag['text'];
						$i->tags[] = $t;
					}
					$this->images[] = $i;
				}
			}

			// if there is actual voicenote data, save process it...
			if(trim($a['person']['voiceNote']['data']) != "") {
				$v = new voiceNote();
				$v->init();
				$v->p_uuid      = $this->p_uuid;
				$v->dataBase64  = $a['person']['voiceNote']['data'];
				$v->length      = $a['person']['voiceNote']['length'];
				$v->format      = $a['person']['voiceNote']['format'];
				$v->sample_rate = $a['person']['voiceNote']['sampleRate'];
				$v->channels    = $a['person']['voiceNote']['numberOfChannels'];
				$v->speaker     = $a['person']['voiceNote']['speaker'];
				$this->voice_note = $v;
			}

			// check for p_uuid collision with already present data, return 401 error if p_uuid already exists
			$q = "
				SELECT count(*)
				FROM person_uuid
				WHERE p_uuid = '".mysql_real_escape_string((string)$this->p_uuid)."';
			";
			$result = $this->db->Execute($q);
			if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person check p_uuid collision ((".$q."))"); }

			if((int)$result->fields['count(*)'] > 0 ) {
				return (int)401;
			}

			// check if reported p_uuid is valid (in range of sequence) ~ 402 error if not
			if(!shn_is_p_uuid_valid($this->p_uuid)) {
				return (int)402;
			}

			// check if the event is closed to reporting...
			if(!$this->isEventOpen()) {
				return (int)405;
			}

			// no errors
			return (int)0;


		// parse REUNITE2 XML
		} elseif($this->xmlFormat == "REUNITE2") {

			$this->arrival_reunite = true;

			// figure out the incident_id
			$shortName = strtolower($a['lpfContent']['person']['eventShortName']);
			$q = "
				SELECT *
				FROM incident
				WHERE shortname = '".mysql_real_escape_string((string)$shortName)."';
			";

			$result = $this->db->Execute($q);
			if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person get incident ((".$q."))"); }

			if($result != NULL && !$result->EOF) {
				$this->incident_id = $result->fields['incident_id'];
			} else {
				return (int)406;
			}

			// extract other xml data
			$this->createUUID();
			$this->given_name     = $a['lpfContent']['person']['firstName'];
			$this->family_name    = $a['lpfContent']['person']['familyName'];
			$this->opt_status     = substr(strtolower($a['lpfContent']['person']['status']['healthStatus']), 0, 3);
			$this->last_updated   = date('Y-m-d H:i:s');
			$this->creation_time  = $a['lpfContent']['person']['dateTimeSent'];
			$this->opt_gender     = substr(strtolower($a['lpfContent']['person']['gender']), 0, 3);
			$this->years_old      = $a['lpfContent']['person']['estimatedAgeInYears'];
			$this->minAge         = $a['lpfContent']['person']['ageGroup']['minAge'];
			$this->maxAge         = $a['lpfContent']['person']['ageGroup']['maxAge'];
			$this->other_comments = $a['lpfContent']['person']['notes'];

			// check if the event is closed to reporting...
			if(!$this->isEventOpen()) {
				return (int)405;
			}

			// no errors
			return (int)0;


		// parse TRIAGEPIC1 XML
		} elseif($this->xmlFormat == "TRIAGEPIC1") {

			$this->arrival_triagepic = true;

			$this->edxl = new personEdxl();
			$this->edxl->init();

			// when we have more than 1 contentObject, they are renamed to 0...x
			if(isset($a['EDXLDistribution'][0])) {
				$ix = 0;

			// when there is only 1 contentObject, we go by name
			} elseif(isset($a['EDXLDistribution']['contentObject'])) {
				$ix = "contentObject";

			// all else, we fail and quit
			} else {
				return (int)403; // error code for failed to parse xml
			}

			$this->createUUID();
			$this->family_name = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['lastName'];
			$this->given_name  = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['firstName'];

			$eventName = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['eventName'];
			$q = "
				SELECT *
				FROM incident
				WHERE shortname = '".mysql_real_escape_string((string)$eventName)."';
			";
			$result = $this->db->Execute($q);
			if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person get incident ((".$q."))"); }

			$this->incident_id = $result->fields["incident_id"];


			$b = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['triageCategory'];
			if(($b == "Green") || ($b == "BH Green")) {
				$this->opt_status = "ali";
			} elseif(($b == "Yellow") || ($b == "Red") || ($b == "Gray")) {
				$this->opt_status = "inj";
			} elseif($b == "Black") {
				$this->opt_status = "dec";
			} else {
				$this->opt_status = "unk";
			}

			$this->last_updated = date('Y-m-d H:i:s');

			// <dateTimeSent>2011-03-28T07:52:17Z</dateTimeSent>
			$datetime      = $a['EDXLDistribution']['dateTimeSent'];
			$timezoneUTC   = new DateTimeZone("UTC");
			$timezoneLocal = new DateTimeZone(date_default_timezone_get());
			$datetime2     = new DateTime();
			$datetime2->setTimezone($timezoneUTC);
			$datetime2->setTimestamp(strtotime($datetime));
			$datetime2->setTimezone($timezoneLocal);
			$this->creation_time = $datetime2->format('Y-m-d H:i:s');

			$this->opt_gender = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['gender'];

			$peds = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['peds'];

			if($peds == "Y") {
				$this->minAge = 0;
				$this->maxAge = 17;
			} elseif($peds == "N") {
				$this->minAge = 18;
				$this->maxAge = 150;
			} elseif($peds == "Y,N") {
				$this->minAge = 0;
				$this->maxAge = 150;
			}

			$this->other_comments = $a['EDXLDistribution'][$ix]['contentDescription'];


			$orgId  = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['organization']['orgId'];
			$q = "
				SELECT *
				FROM hospital
				WHERE npi = '".mysql_real_escape_string((string)$orgId)."';
			";
			$result = $this->db->Execute($q);
			if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person get hospital ((".$q."))"); }

			$this->hospital_uuid = $result->fields["hospital_uuid"];
			$this->last_seen     = $result->fields["name"]." Hospital";

			$this->edxl->content_descr   = $a['EDXLDistribution'][$ix]['contentDescription'];
			$this->edxl->p_uuid          = $this->p_uuid;
			$this->edxl->schema_version  = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['version'];
			$this->edxl->login_machine   = "n/a"; //null; HACK! cant be null
			$this->edxl->login_account   = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['login']['userName'];
			$this->edxl->person_id       = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['personId'];
			$this->edxl->event_name      = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['eventName'];
			$this->edxl->event_long_name = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['eventLongName'];
			$this->edxl->org_name        = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['organization']['orgName'];
			$this->edxl->org_id          = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['organization']['orgId'];
			$this->edxl->last_name       = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['lastName'];
			$this->edxl->first_name      = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['firstName'];
			$this->edxl->gender          = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['gender'];
			$this->edxl->peds            = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['peds'];
			$this->edxl->triage_category = $a['EDXLDistribution'][$ix]['xmlContent']['lpfContent']['person']['triageCategory'];
			$this->edxl->when_sent       = $this->last_updated;
			$this->edxl->sender_id       = $a['EDXLDistribution']['senderID'];
			$this->edxl->distr_id        = $a['EDXLDistribution']['distributionID'];
			$this->edxl->distr_status    = $a['EDXLDistribution']['distributionStatus'];
			$this->edxl->distr_type      = $a['EDXLDistribution']['distributionType'];
			$this->edxl->combined_conf   = $a['EDXLDistribution']['combinedConfidentiality'];
			$this->edxl->language        = null;
			$this->edxl->when_here       = $this->creation_time;
			$this->edxl->inbound         = 1; //null; HACK! cant be null
			$this->edxl->type            = "lpf";

			// parse all images
			for($n = 0; $n < sizeof($a['EDXLDistribution']); $n++) {
				if(isset($a['EDXLDistribution'][$n]['nonXMLContent']) && $a['EDXLDistribution'][$n]['nonXMLContent'] != null) {

					$imageNode = $a['EDXLDistribution'][$n]['nonXMLContent'];

					// create sahana image
					if(trim($imageNode['contentData']) != "") {
						$i = new personImage();
						$i->init();
						$i->p_uuid = $this->p_uuid;
						$i->fileContentBase64 = $imageNode['contentData'];
						$i->original_filename = $imageNode['uri'];
						$this->images[] = $i;
					}

					// create edxl image
					$this->edxl->mimeTypes[]    = $imageNode['mimeType'];
					$this->edxl->uris[]         = $imageNode['uri'];
					$this->edxl->contentDatas[] = $imageNode['contentData'];
					$this->edxl->image_ids[]    = $i->image_id;
					$this->edxl->image_co_ids[] = shn_create_uuid("edxl_co_header");
				}
			}

			// check if the event is closed to reporting...
			if(!$this->isEventOpen()) {
				return (int)405;
			}

			// exit with success
			return (int)0;

		// parse TRIAGEPIC0 XML
		} elseif($this->xmlFormat == "TRIAGEPIC0") {

			$this->arrival_triagepic = true;

			$this->edxl = new personEdxl();
			$this->edxl->init();

			$this->createUUID();
			$this->family_name = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['lastName'];
			$this->given_name  = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['firstName'];

			$eventName = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['eventName'];
			$q = "
				SELECT *
				FROM incident
				WHERE shortname = '".mysql_real_escape_string((string)$eventName)."';
			";
			$result = $this->db->Execute($q);
			if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person get incident ((".$q."))"); }

			$this->incident_id = $result->fields["incident_id"];


			$b = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['triageCategory'];
			if(($b == "Green") || ($b == "BH Green")) {
				$this->opt_status = "ali";
			} elseif(($b == "Yellow") || ($b == "Red") || ($b == "Gray")) {
				$this->opt_status = "inj";
			} elseif($b == "Black") {
				$this->opt_status = "dec";
			} else {
				$this->opt_status = "unk";
			}

			$this->last_updated = date('Y-m-d H:i:s');

			// <dateTimeSent>2011-03-28T07:52:17Z</dateTimeSent>
			$datetime      = $a['EDXLDistribution']['dateTimeSent'];
			$timezoneUTC   = new DateTimeZone("UTC");
			$timezoneLocal = new DateTimeZone(date_default_timezone_get());
			$datetime2     = new DateTime();
			$datetime2->setTimezone($timezoneUTC);
			$datetime2->setTimestamp(strtotime($datetime));
			$datetime2->setTimezone($timezoneLocal);
			$this->creation_time = $datetime2->format('Y-m-d H:i:s');

			$this->opt_gender = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['gender'];

			$peds = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['peds'];

			if($peds == "Y") {
				$this->minAge = 0;
				$this->maxAge = 17;
			} elseif($peds == "N") {
				$this->minAge = 18;
				$this->maxAge = 150;
			} elseif($peds == "Y,N") {
				$this->minAge = 0;
				$this->maxAge = 150;
			}

			$this->other_comments = $a['EDXLDistribution']['contentObject']['contentDescription'];


			$orgId  = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['organization']['orgId'];
			$q = "
				SELECT *
				FROM hospital
				WHERE npi = '".mysql_real_escape_string((string)$orgId)."';
			";
			$result = $this->db->Execute($q);
			if($result === false) { daoErrorLog(__FILE__, __LINE__, __METHOD__, __CLASS__, __FUNCTION__, $this->db->ErrorMsg(), "person get hospital ((".$q."))"); }

			$this->hospital_uuid = $result->fields["hospital_uuid"];
			$this->last_seen     = $result->fields["name"]." Hospital";

			$this->edxl->content_descr   = $a['EDXLDistribution']['contentObject']['contentDescription'];
			$this->edxl->p_uuid          = $this->p_uuid;
			$this->edxl->schema_version  = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['version'];
			$this->edxl->login_machine   = "n/a"; //null; HACK! cant be null
			$this->edxl->login_account   = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['login']['username'];
			$this->edxl->person_id       = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['personId'];
			$this->edxl->event_name      = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['eventName'];
			$this->edxl->event_long_name = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['eventLongName'];
			$this->edxl->org_name        = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['organization']['orgName'];
			$this->edxl->org_id          = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['organization']['orgId'];
			$this->edxl->last_name       = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['lastName'];
			$this->edxl->first_name      = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['firstName'];
			$this->edxl->gender          = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['gender'];
			$this->edxl->peds            = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['peds'];
			$this->edxl->triage_category = $a['EDXLDistribution']['contentObject']['xmlContent']['embeddedXMLContent']['lpfContent']['person']['triageCategory'];
			$this->edxl->when_sent       = $this->last_updated;
			$this->edxl->sender_id       = $a['EDXLDistribution']['senderID'];
			$this->edxl->distr_id        = $a['EDXLDistribution']['distributionID'];
			$this->edxl->distr_status    = $a['EDXLDistribution']['distributionStatus'];
			$this->edxl->distr_type      = $a['EDXLDistribution']['distributionType'];
			$this->edxl->combined_conf   = $a['EDXLDistribution']['combinedConfidentiality'];
			$this->edxl->language        = null;
			$this->edxl->when_here       = $this->creation_time;
			$this->edxl->inbound         = 1; //null; HACK! cant be null
			$this->edxl->type            = "lpf";

			// check if the event is closed to reporting...
			if(!$this->isEventOpen()) {
				return (int)405;
			}

			// exit with success
			return (int)0;

		// how did we get here?
		} else {
			return (int)9999;
		}
	}
}



