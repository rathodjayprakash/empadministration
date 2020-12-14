#
# Table structure for table 'tx_empadministration_domain_model_office'
#
CREATE TABLE tx_empadministration_domain_model_office (

	name varchar(255) DEFAULT '' NOT NULL,
	address text,
	contact_details text,
	departments text NOT NULL

);

#
# Table structure for table 'tx_empadministration_domain_model_department'
#
CREATE TABLE tx_empadministration_domain_model_department (

	name varchar(255) DEFAULT '' NOT NULL,
	projects text NOT NULL,
	employees text NOT NULL

);

#
# Table structure for table 'tx_empadministration_domain_model_employee'
#
CREATE TABLE tx_empadministration_domain_model_employee (

	name varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	phone_number varchar(255) DEFAULT '' NOT NULL,
	password varchar(255) DEFAULT '' NOT NULL,
	position int(11) unsigned DEFAULT '0'

);

#
# Table structure for table 'tx_empadministration_domain_model_project'
#
CREATE TABLE tx_empadministration_domain_model_project (

	name varchar(255) DEFAULT '' NOT NULL,
	employees text NOT NULL
);

#
# Table structure for table 'tx_empadministration_domain_model_positions'
#
CREATE TABLE tx_empadministration_domain_model_positions (

	title varchar(255) DEFAULT '' NOT NULL

);

#
# Table structure for table 'tx_empadministration_domain_model_projectassignment'
#
CREATE TABLE tx_empadministration_domain_model_projectassignment (

	hours_from int(11) DEFAULT '0' NOT NULL,
	hours_to int(11) DEFAULT '0' NOT NULL,
	task_info text,
	project int(11) unsigned DEFAULT '0',
	employee int(11) unsigned DEFAULT '0'

);
