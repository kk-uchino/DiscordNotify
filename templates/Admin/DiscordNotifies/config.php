<?php
$this->BcAdmin->setTitle('Discord通知プラグイン設定');
?>

<?php if ($mailContents->count()) : ?>
  <?php echo $this->BcAdminForm->create($discordNotifies) ?>
  <section class="bca-section">
    <table class="form-table bca-form-table">
      <?php foreach ($mailContents as $key => $mailContent) : ?>
        <tr>
          <th class="col-head bca-form-table__label" style="word-break: break-all;">
            <?php echo h($mailContent->content->title . ' (' . urldecode($mailContent->content->name) . ')') ?>
          </th>
          <td class="col-input bca-form-table__input">
            <?php echo $this->BcAdminForm->control($mailContent->id . '.id', ['type' => 'hidden']) ?>
            <?php echo $this->BcAdminForm->control($mailContent->id . '.mail_content_id', ['type' => 'hidden']) ?>
            <div style="margin-top: 14px">
              <?php echo $this->BcAdminForm->control($mailContent->id . '.status', ['type' => 'checkbox', 'label' => '有効にする']) ?>
              <?php echo $this->BcAdminForm->error($mailContent->id . '.status') ?>
            </div>
            <div style="margin-top: 14px">
              <?php echo $this->BcAdminForm->label($mailContent->id . '.webhook_url', 'Webhook URL') ?><br>
              <?php echo $this->BcAdminForm->control($mailContent->id . '.webhook_url', ['type' => 'text', 'size' => 80, 'maxlength' => 255]) ?><br>
              <?php echo $this->BcAdminForm->error($mailContent->id . '.webhook_url') ?>
            </div>
            <div style="margin-top: 14px">
              <?php echo $this->BcAdminForm->label($mailContent->id . '.user_name', 'ユーザー名') ?><br>
              <?php echo $this->BcAdminForm->control($mailContent->id . '.user_name', ['type' => 'text', 'size' => 40, 'maxlength' => 255]) ?><br>
              <?php echo $this->BcAdminForm->error($mailContent->id . '.user_name') ?>
            </div>
            <div style="margin-top: 14px">
              <?php echo $this->BcAdminForm->label($mailContent->id . '.message', 'メッセージ') ?><br>
              <?php echo $this->BcAdminForm->control($mailContent->id . '.message', ['type' => 'textarea']) ?><br>
              <span style="font-size: 1.2rem; color: #888;">
                送信データの表示は {{フィールド名}} の形式で記述してください。<br>
                メンションは以下のように設定できます。<br>
                @ロール: &lt;@&ROLL_ID&gt;, @ユーザー: &lt;@USER_ID&gt;<br>
                ※ USER_IDはDiscordアプリから アプリの設定 > 詳細設定 > 開発者モード を有効にした後、ユーザー名を右クリックして「IDをコピー」をクリックすることで取得できます。<br>
                ※ ROLL_IDはDiscordアプリから アプリの設定 > 詳細設定 > 開発者モード を有効にした後、 サーバー設定 > ロール から「IDをコピー」をクリックすることで取得できます。<br>
                ※ @everyone, @here はそのまま記述してください。
              </span>
              <?php echo $this->BcAdminForm->error($mailContent->id . '.message') ?>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </table>
  </section>
  <section class="bca-actions">
    <div class="bca-actions__main">
      <?php echo $this->BcAdminForm->button(__d('baser', '保存'), [
        'type' => 'submit',
        'id' => 'BtnSave',
        'div' => false,
        'class' => 'button bca-btn bca-actions__item',
        'data-bca-btn-type' => 'save',
        'data-bca-btn-size' => 'lg',
        'data-bca-btn-width' => 'lg',
      ]) ?>
    </div>
  </section>
  <?php echo $this->BcAdminForm->end() ?>
<?php else : ?>
  <p>メールフォームがありません。</p>
<?php endif ?>