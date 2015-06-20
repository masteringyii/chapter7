<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 * @property string  $content
 * @property integer $author_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{
	/** 
     * Allow yii to handle population of created_at and updated_at time
     */
    public function behaviors()
    {   
        return [
            TimestampBehavior::className(),
			[
            	'class' => SluggableBehavior::className(),
            	'attribute' => 'title',
            	'slugAttribute' => 'slug',
        	],
        ];  
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'content'], 'required'],
            [['content'], 'string'],
            [['author_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'title'         => 'Title',
            'slug'          => 'Slug',
            'content'       => 'Content',
            'author_id'     => 'Author ID',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
