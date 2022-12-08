<?php echo $this->BcForm->create('DiscordNotifyConfig') ?>

<section class="bca-section">
	<table class="form-table bca-form-table">
		<?php if (!empty($mailContents)) : ?>
			<?php foreach ($mailContents as $mailContent) : ?>
				<tr>
					<th class="col-head bca-form-table__label">
						<?php echo $this->BcForm->label('DiscordNotify.' . $mailContent['MailContent']['id'] . '.webhook_url', $mailContent['Content']['title'] . ' (' . urldecode($mailContent['Content']['name']) . ')', ['style' => 'word-break: break-all;']) ?>
					</th>
					<td class="col-input bca-form-table__input">
						<?php echo $this->BcForm->input('DiscordNotify.' . $mailContent['MailContent']['id'] . '.id', ['type' => 'hidden', 'value' => $mailContent['MailContent']['id']]) ?>
						<?php echo $this->BcForm->input('DiscordNotify.' . $mailContent['MailContent']['id'] . '.mail_content_id', ['type' => 'hidden', 'value' => $mailContent['MailContent']['id']]) ?>
						<p>
							<?php echo $this->BcForm->input('DiscordNotify.' . $mailContent['MailContent']['id'] . '.status', ['type' => 'checkbox', 'label' => '有効にする', 'autofocus' => true]) ?>
							<?php echo $this->BcForm->error('DiscordNotify.' . $mailContent['MailContent']['id'] . '.status') ?>
						</p>
						<p>
							<?php echo $this->BcForm->label('DiscordNotify.' . $mailContent['MailContent']['id'] . '.webhook_url', 'Webhook URL') ?><br>
							<?php echo $this->BcForm->input('DiscordNotify.' . $mailContent['MailContent']['id'] . '.webhook_url', ['type' => 'text', 'size' => 80, 'maxlength' => 255, 'autofocus' => true]) ?><br>
							<?php echo $this->BcForm->error('DiscordNotify.' . $mailContent['MailContent']['id'] . '.webhook_url') ?>
						</p>
						<p>
							<?php echo $this->BcForm->label('DiscordNotify.' . $mailContent['MailContent']['id'] . '.user_name', 'ユーザー名') ?><br>
							<?php echo $this->BcForm->input('DiscordNotify.' . $mailContent['MailContent']['id'] . '.user_name', ['type' => 'text', 'size' => 40, 'maxlength' => 255, 'autofocus' => true]) ?><br>
							<?php echo $this->BcForm->error('DiscordNotify.' . $mailContent['MailContent']['id'] . '.user_name') ?>
						</p>
						<p>
							<?php echo $this->BcForm->label('DiscordNotify.' . $mailContent['MailContent']['id'] . '.message', 'メッセージ') ?><br>
							<?php echo $this->BcForm->input('DiscordNotify.' . $mailContent['MailContent']['id'] . '.message', ['type' => 'textarea', 'autofocus' => true]) ?><br>
							<span style="font-size: 1.2rem; color: #888;">
								送信データの表示は {{フィールド名}} の形式で記述してください。<br>
								メンションは以下のように設定できます。<br>
								@ロール: &lt;@&ROLL_ID&gt;, @ユーザー: &lt;@USER_ID&gt;<br>
								※ USER_IDはDiscordアプリから アプリの設定 > 詳細設定 > 開発者モード を有効にした後、ユーザー名を右クリックして「IDをコピー」をクリックすることで取得できます。<br>
								※ ROLL_IDはDiscordアプリから アプリの設定 > 詳細設定 > 開発者モード を有効にした後、 サーバー設定 > ロール から「IDをコピー」をクリックすることで取得できます。<br>
								※ @everyone, @here はそのまま記述してください。
							</span>
							<?php echo $this->BcForm->error('DiscordNotify.' . $mailContent['MailContent']['id'] . '.message') ?>
						</p>
					</td>
				</tr>
			<?php endforeach ?>
		<?php else : ?>
			<p>メールフォームがありません。</p>
		<?php endif ?>
	</table>
</section>

<section class="bca-actions">
	<div class="bca-actions__main">
		<?php echo $this->BcForm->button(__d('baser', '保存'), [
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

<?php echo $this->BcForm->end() ?>
