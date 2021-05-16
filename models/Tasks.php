<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $type_task_id
 * @property int|null $groups_id
 * @property int|null $projects_id
 * @property string|null $data_begin
 * @property string|null $data_end
 * @property int|null $parent_id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int $active
 * @property int|null $lock
 *
 * @property Periods[] $periods
 * @property TaskAction[] $taskActions
 * @property TypeTask $typeTask
 * @property Groups $groups
 * @property Projects $projects
 * @property Tasks $parent
 * @property Tasks[] $tasks
 * @property Users $createdBy
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by', 'active'], 'required'],
            [['description'], 'string'],
            [['type_task_id', 'groups_id', 'projects_id', 'parent_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'active', 'lock'], 'integer'],
            [['data_begin', 'data_end'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['type_task_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeTask::className(), 'targetAttribute' => ['type_task_id' => 'id']],
            [['groups_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groups_id' => 'id']],
            [['projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['projects_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'name' => 'Name',
            'description' => 'Description',
            'type_task_id' => 'Type Task ID',
            'groups_id' => 'Groups ID',
            'projects_id' => 'Projects ID',
            'data_begin' => 'Data Begin',
            'data_end' => 'Data End',
            'parent_id' => 'Parent ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'active' => 'Active',
            'lock' => 'Lock',
        ];
    }

    /**
     * Gets query for [[Periods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriods()
    {
        return $this->hasMany(Periods::className(), ['tasks_id' => 'id']);
    }

    /**
     * Gets query for [[TaskActions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskActions()
    {
        return $this->hasMany(TaskAction::className(), ['tasks_id' => 'id']);
    }

    /**
     * Gets query for [[TypeTask]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeTask()
    {
        return $this->hasOne(TypeTask::className(), ['id' => 'type_task_id']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasOne(Groups::className(), ['id' => 'groups_id']);
    }

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
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['parent_id' => 'id']);
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
}
