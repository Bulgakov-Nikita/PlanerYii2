<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_begin
 * @property string|null $date_end
 * @property string|null $description
 * @property int|null $projects_id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $active
 * @property int|null $lock
 *
 * @property Projects $projects
 * @property Users $createdBy
 * @property Tasks[] $tasks
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by'], 'required'],
            [['date_begin', 'date_end'], 'safe'],
            [['description'], 'string'],
            [['projects_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'active', 'lock'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['projects_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_begin' => 'Дата начала',
            'date_end' => 'Дата завершения',
            'description' => 'Описание',
            'projects_id' => 'Проект ID',
            'created_at' => 'Дата создания',
            'created_by' => 'Создал(а)',
            'updated_at' => 'Дата изменения',
            'updated_by' => 'Изменил(а)',
            'deleted_at' => 'Дата удаления',
            'deleted_by' => 'Удалил(а)',
            'active' => 'Статус',
            'lock' => 'Блокировка',
        ];
    }
//sdasdadasa
    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasOne(Projects::className(), ['id' => 'projects_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['groups_id' => 'id']);
    }

}
