<?php
$I = new UiTester( $scenario );
$I->wantTo( 'check new answer' );
$I->cli( 'user create answertester ct34534f@local.com --role=ap_participant --user_pass=test' );
$id = $I->havePostInDatabase(
	[
		'post_type'  => 'question',
		'post_title' => 'Super sample question',
	]
);
$I->wait( 3 );
$I->amOnPage( '/wp-login.php' );
$I->wait( 3 );
$I->submitForm(
	'#loginform', [
		'log' => 'answertester',
		'pwd' => 'test',
	], '#wp-submit'
);
$I->makeScreenshot( 'login-answer' );
$I->amOnPage( '?p=' . $id );
$I->seeElement( '#answer-form-c' );
$I->scrollTo( '#answer-form-c' );
$I->click( '.ap-editor-fade' );
$I->waitForJS( 'return jQuery.active == 0;', 10 );
$content = 'Ut vestibulum est eget justo facilisis ullamcorper. Donec id lectus tortor. Sed viverra rutrum hendrerit. Integer quis nulla tortor, vel scelerisque quam. Cras eget justo felis.';
$I->fillTinyMceEditorById( 'form_answer-post_content', $content );
$I->click( '#form_answer button[type="submit"]' );
$I->waitForText( 'Answer submitted successfully', 5 );
$I->seeElement( "#post-$id" );
$I->see( $content, "#post-$id" );

$I->wantTo( 'check answer editing' );
$I->amOnPage( '/wp-login.php' );
$I->wait( 3 );
$I->submitForm(
	'#loginform', [
		'log' => 'admin',
		'pwd' => 'admin',
	], '#wp-submit'
);
$id = $I->havePostInDatabase(
	[
		'post_type'  => 'question',
		'post_title' => 'Question {n}',
	]
);
$id = $I->havePostInDatabase(
	[
		'post_type'   => 'answer',
		'post_parent' => $id,
	]
);
$I->amOnPage( '?p=' . $id );
$I->seeElement( '#ap-single' );
$I->click( '#post-' . $id . ' [ap="actiontoggle"]' );
$I->waitForElement( '#post-' . $id . ' .ap-actions li', 30 );
$I->scrollTo( '#post-' . $id . ' .ap-actions li' );
$I->click( 'Edit', '#post-' . $id . ' .ap-actions li' );
$I->seeElement( '#form_answer' );
$I->fillTinyMceEditorById( 'form_answer-post_content', '######edited####answer######' );
$I->click( '#form_answer button[type="submit"]' );
$I->waitForJS( 'return jQuery.active == 0;', 10 );
$I->seeElement( '#ap-single' );
$I->see( '######edited####answer######', '#post-' . $id . ' .ap-answer-content' );
