<?php
namespace Home\Model;
use Think\Model\RelationModel;

class StudentModel extends RelationModel{
	protected $_link = array(
			'student'=>array(
					'mapping_type'  => self::HAS_ONE,
					'class_name'    => 'image',
					'foreign_key'   => 'img_uid',
					'as_fields'     => 'img_name',
			),
	);
}