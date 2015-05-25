<?php
namespace Home\Model;
use Think\Model\RelationModel;

class ImageModel extends RelationModel{
	protected $_link = array(
			'student'=>array(
					'mapping_type'  => self::BELONGS_TO,
					'class_name'    => 'student',
					'foreign_key'   => 'img_uid',
					'as_fields'     => 'stu_academy,stu_id,stu_name',
			),
	);
}