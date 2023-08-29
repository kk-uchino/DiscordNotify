<?php
declare(strict_types=1);

namespace DiscordNotify\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DiscordNotifies Model
 *
 * @property \DiscordNotify\Model\Table\MailContentsTable&\Cake\ORM\Association\BelongsTo $MailContents
 *
 * @method \DiscordNotify\Model\Entity\DiscordNotify newEmptyEntity()
 * @method \DiscordNotify\Model\Entity\DiscordNotify newEntity(array $data, array $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify[] newEntities(array $data, array $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify get($primaryKey, $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \DiscordNotify\Model\Entity\DiscordNotify[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DiscordNotifiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('discord_notifies');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MailContents', [
            'foreignKey' => 'mail_content_id',
            'joinType' => 'INNER',
            'className' => 'BcMail.MailContents',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('mail_content_id')
            ->notEmptyString('mail_content_id');

        $validator
            ->notEmptyString('status');

        $validator
            ->scalar('webhook_url')
            ->maxLength('webhook_url', 255, __d('baser', 'Webhook URLは255文字以内で入力してください。'))
            ->allowEmptyString('webhook_url');

        $validator
            ->scalar('user_name')
            ->maxLength('user_name', 255, __d('baser', 'ユーザー名は255文字以内で入力してください。'))
            ->allowEmptyString('user_name');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('mail_content_id', 'MailContents'), ['errorField' => 'mail_content_id']);

        return $rules;
    }
}
