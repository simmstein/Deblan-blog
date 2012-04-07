<?php
	
class sfGuardUserAdminFrontForm extends sfGuardUserAdminForm {
	public function configure() {
		parent::configure();

		unset(
			$this['username'], 
			$this['is_active'], 
			$this['is_super_admin'], 
			$this['sf_guard_user_group_list'], 
			$this['sf_guard_user_permission_list'],
			$this['algorithm'],
			$this['salt'],
			$this['updated_at'],
			$this['created_at'],
			$this['last_login']
		);

		$this->setWidget('description', new sfWidgetFormTextareaTinyMCECustom(array(
			'height' => 600
		)));

		$this->setWidget(
			'avatar', 
			new sfWidgetFormInputFileEditable(array(
				'file_src'  => '/uploads/avatars/'.$this->getObject()->getProfile()->getAvatar(),
				'is_image'  => true,
				'edit_mode' => !$this->isNew() && $this->getObject()->getProfile()->getAvatar(),
				'template'  => 
				'<a '.(($this->getObject()->getProfile()->getAvatar()) ? 'data-content="&lt;img src=\'/'.$this->getObject()->getProfile()->getAvatar().'\'/&gt;" data-original-title="Aperçu" rel="popover-left"' : '').'>
					<div>%file%</div>
					%input% 
					<div class="file_editable">
						%delete_label% 
						%delete%
					</div>
				</a>',
			)
		));

		$this->setValidator(
			'email',
			new sfValidatorEmail(array(
				'required' => false
			))
		);

		$this->setValidator(
			'avatar', 
			new sfValidatorFileImage(
				array(
					'path' => 'uploads/avatars/',
					'required' => false,
					'max_size' => 5000000,
					'min_width' => 90,
					'min_height' => 90,
					'max_width' => 1000,
					'max_height' => 1000,
					'validated_file_class' => 'sfValidatedAvatarFile'
				),
				array(
					'mime_types' => "Formats d'image attendu : *.jpg, *.jpeg, *.gif, *.png",
					'max_size' => 'Taille maximale de l\'avatar est 5Mo.',
					'min_width' => 'Largeur minimale : 90px',
					'max_width' => 'Largeur maximale : 1000px',
					'min_height' => 'Hauteur minimale : 90px',
					'max_height' => 'Hauteur maximale : 1000px'
				)
			)
		);
		
		$this->validatorSchema['avatar_file_delete'] = new sfValidatorBoolean();
	}

	/**
	 *
	 * FIXME: Gros bug à l'envoi d'avatar (ou quand on enregistre son profil sans avatar)
	 *
	 */
	public function updateObject($values = null) {
		parent::updateObject($values);

		if (!is_null($profile = $this->getProfile()))
		{
			$values = $this->getValues();
			unset($values[$this->getPrimaryKey()]);
			
			$aux = array();
			foreach($values as $key => $value)
			{
				if($key == 'avatar')
				{
					if($value) 
					{
						$value->save();
						$aux[$key] = $value->getSavedName();	
					}
					else 
					{
						$aux[$key] = $profile->getAvatar();
					}
				}
				else
				{
					$aux[$key] = $value;
				}
			}

			$profile->fromArray($aux, BasePeer::TYPE_FIELDNAME);
			$profile->save();
		}

		return $this->object;
	}	
}
