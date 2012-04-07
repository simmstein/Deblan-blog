<?php
	
class ContactForm extends sfForm {
	private $subjects = array(
		"Proposition d'article", 
		"Demande d'information",
		"Déclaration de bug", 
		"Autres"
	);

	public function getSubjects() {
		return $this->subjects;
	}

	public function configure() {
		$this->widgetSchema->setNameFormat('contact[%s]');
		$this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

		$this->setWidget('name', new sfWidgetFormInput());

		$this->setWidget('email', new sfWidgetFormInput());

		$this->setWidget(
			'subject', 
			new sfWidgetFormChoice(array(
				'choices' => $this->subjects
			))
		);
		
		$this->setWidget('message', new sfWidgetFormTextareaTinyMCECustom(array(
			'width' => 500,
			'height' => 300
		)));

		$this->setValidator(
			'name', 
			new sfValidatorString(array(
				'required' => true
			))
		);

		$this->setValidator(
			'email',
			new sfValidatorEmail(array(
				'required' => true
			))
		);

		$this->setValidator(
			'subject',
			new sfValidatorChoice(array(
				'required' => true,
				'choices' => array_keys($this->subjects)
			))
		);

		$this->setValidator(
			'message',
			new sfValidatorString(array(
				'required' => true
			))
		);
	}
}
