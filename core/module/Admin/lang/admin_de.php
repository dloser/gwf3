<?php
$lang = array(
	# Admin Config
	'cfg_users_per_page' => 'Benutzer pro Seite',	
	'cfg_super_hash' => 'Zusatz-Passwort für das Admin Modul',
	'cfg_super_time' => 'Zeitspanne für eine Admin Session',

	# Info
	'install_info' => 'Einige Module benötigen ein Update. Sie können auch <a href="%s">alle Module updaten und installieren</a>.',
	'info_methods' => 'Prüfe %s Funktionen dieses Moduls...',
	
	# Select
	'sel_group' => 'Benutzergruppe wählen',
	
	# Titles
	'form_title' => '%s konfigurieren',
	'ft_setup' => 'Superuser Passwort für das Admin-Modul festlegen',
	'ft_prompt' => 'Bitte geben sie das Superuser Passwort ein',
	'ft_login_as' => 'Als beliebiger User einloggen',
	'ft_useredit' => 'Den Benutzer %s editieren',
	'ft_search' => 'In der Benutzer Tabelle suchen.',
	'ft_edit_group' => 'Benutzergruppe %s bearbeiten',
	'ft_add_to_group' => 'Einen Benutzer zu der Gruppe hinzufügen',

	# Errors
	'err_mod_not_installed' => 'Dieses Modul ist nicht installiert.',
	'err_not_installed' => 'Das Modul %s ist noch nicht installiert.',
	'err_arg_script' => 'Sie können den Wert für &quot;%s&quot; nicht manuell ändern.',
	'err_arg_type' => 'Ungültiger Wert für &quot;%s&quot;.',
	'err_arg_range' => 'Der Wert für &quot;%s&quot; muss zwischen %s und %s betragen.',
	'err_arg_key' => 'Unbekannte Variable &quot;%s&quot;.',
	'err_update' => 'Ein Fehler ist während des Updates aufgetreten.',
	'err_install' => 'Ein Fehler ist während des Installs aufgetreten.',
	'err_check_pass' => 'Das Superuser Passwort ist falsch.',
	'err_username_taken' => 'Der Nickname ist bereits vergeben.',
	'err_username' => 'Der Nickname ist ungültig.',
	'err_email' => 'Die EMail ist ungültig.',
	'err_gender' => 'Das Geschlecht ist ungültig.',
	'err_group' => 'Unbekannte Gruppen-ID.',
	'err_group_view' => 'Die Gruppen-Sichtbarkeit ist ungültig.',
	'err_group_join' => 'Die Gruppen-Einstellung zum Beitreten ist ungültig.',
	'err_in_group' => 'Der Benutzer ist bereits in dieser Gruppe.',
	'err_disable_core_module' => 'Sie können dieses Modul nicht deaktivieren, weil es ein Hauptbestandteil des Systems ist.',

	# Messages
	'msg_update_var' => 'Der Wert für &quot;%s&quot; wurde auf %s gesetzt.',
	'msg_update' => 'Das Modul wurde konfiguriert.',
	'msg_install' => 'Das Modul %s wurde (re)installiert. Führe Datenbank Updates aus...',
	'msg_wipe_confirm' => 'Möchten sie wirklich die Datenbank für das Modul %s löschen?',
	'msg_wipe' => 'Das Modul %s wurde aus der Datenbank entfernt. Alle Daten sind verloren und seine Tabelle(n) wurde(n) neu angelegt.',
	'msg_installed' => 'Sie können nun fortfahren und <a href="%s">das Modul %s konfigurieren</a>.',
	'msg_install_all' => 'Alle Module wurden installiert und auf den neuesten Stand gebracht.<br/><a href="%s">Klicken Sie hier um zu der Modulübersicht zurückzukehren</a>.',
	'msg_enabled' => 'Das Modul wurde aktiviert.',
	'msg_disabled' => 'Das Modul wurde deaktiviert.',
	'msg_pass_cleared' => 'Das Superuser Passwort wurde gelöscht.',
	'msg_pass_set' => 'Das Superuser Passwort lautet ab jetzt &quot;%s&quot;<br/>Bewahren Sie dieses sicher auf, da sie es nicht einfach wiederherstellen oder löschen können.',
	'msg_login_as' => 'Sie sind nun eingeloggt als %s.',
	'msg_userpass_changed' => 'Das Passwort für %s lautet nun &quot;%s&quot;.',
	'msg_username_changed' => 'Der Benutzer %s heisst nun %s.',
	'msg_user_edited' => 'Der Benutzer wurde erfolgreich editiert.',
	'msg_deleted' => 'Der Benutzer wurde als gelöscht markiert.',
	'msg_undeleted' => 'Der Benutzer wurde aktiviert.',
	'msg_bot_0' => 'Der Benutzer ist nicht länger als Bot markiert.',
	'msg_bot_1' => 'Der Benutzer wurde als Bot markiert.',
	'msg_showemail_0' => 'Die Benutzer EMail ist nun versteckt.',
	'msg_showemail_1' => 'Die Benutzer EMail ist nun öffentlich.',
	'msg_adult_0' => 'Der Benutzer kann keinen Inhalt für Erwachsene mehr sehen.',
	'msg_adult_1' => 'Der Benutzer kann nun Inhalt für Erwachsene sehen.',
	'msg_online_0' => 'Der Online Status des Benutzers ist nun sichtbar.',
	'msg_online_1' => 'Der Online Status des Benutzers ist nun versteckt.',
	'msg_approved_0' => 'Die EMail des Benutzers ist nun nicht mehr bestätigt.',
	'msg_approved_1' => 'Die EMail des Benutzers ist nun bestätigt.',
	'msg_module_enabled' => 'Das %s Modul wurde aktiviert.',
	'msg_module_disabled' => 'Das %s Modul wurde deaktiviert.',
	'msg_new_path' => 'Der Modul-Pfad wurde erfolgreich geändert.',
	'msg_new_name' => 'Das Modul wurde umbenannt zu %s. <b>Warnung</b>: Das wird sicherlich alle URLs ungültig machen!',
	'msg_defaults' => 'Alle Modul-Variablen wurden auf Werkseinstellungen zurückgesetzt.',
	'msg_removed_from_grp' => 'Der Benutzer %s wurde aus der Gruppe %s entfernt.',
	'msg_added_to_grp' => 'Der Benutzer %s wurde der Gruppe %s hinzugefügt.',

	# Table Headers
	'th_modulename' => 'Modul',
	'th_path' => 'Pfad',
	'th_version_db' => 'Version ',
	'th_version_hd' => 'Verfügbar',
	'th_priority' => 'Priorität',
	'th_move' => 'Verschieben',
	'th_name' => 'Modul-Name',
	'th_install' => 'Installieren',
	'th_basic' => 'Konfigurieren',
	'th_adv' => 'Admin Bereich',
	'th_enabled' => 'Das Modul ist aktiviert',
	'th_disabled' => 'Das Modul ist deaktiviert',
	'th_new_pass' => 'Neues Passwort',
	'th_check_pass' => 'Passwort',
	'th_userid' => 'ID ',
	'th_user_name' => 'Nickname',
	'th_email' => 'EMail',
	'th_lastactivity' => 'Letzte Aktivität',
	'th_regip' => 'Registrierungs IP',
	'th_regdate' => 'Registrierungs Datum',
	'th_gender' => 'Geschlecht',
	'th_country' => 'Land',
	'th_lang_1' => 'Muttersprache',
	'th_lang_2' => 'Fremdsprache',
	'th_is_approved' => 'Hat eine bestätigte EMail?',
	'th_is_bot' => 'Ist ein Bot?',
	'th_hide_online' => 'Online Status Verstecken?',
	'th_show_email' => 'EMail öffentlich sichtbar?',
	'th_want_adult' => 'Möchte Inhalt f.Erwachsene?',
	'th_deleted' => 'Ist als gelöscht markiert?',
	'th_birthdate' => 'Geburtsdatum',
	'th_cfg_div' => '%s Variablen',
	'th_group_name' => 'Benutzergruppe',
	'th_group_sel_view' => 'Sichtbarkeit',
	'th_group_sel_join' => 'Beitreten',
	'th_group_lang' => 'Sprache',
	'th_group_country' => 'Land',
	'th_group_founder' => 'Gründer',
	'th_group_options&1' => 'Voll',
	'th_group_options&2' => 'Durch Einladung',
	'th_group_options&4' => 'Moderierte Liste',
	'th_group_options&8' => 'Klick&Join',
	'th_group_options&16' => '[script] Voll',
	'th_group_options&'.(0x100) => 'Öffentlich Sichtbar',
	'th_group_options&'.(0x200) => 'Angemeldet Sichtbar',
	'th_group_options&'.(0x400) => 'Nur für Gruppe Sichtbar',
	'th_group_options&'.(0x800) => '[script] Nur Gruppe',
	'th_group_id' => 'ID ',
	'th_group_memberc' => '# ',
	'th_group_join' => 'Beitritt durch',
	'th_group_view' => 'Sichtbarkeit',
	
	# Buttons
	'btn_install' => 'Installieren',
	'btn_reinstall' => 'Datenbank Löschen',
	'btn_update' => 'Updaten',
	'btn_edit' => 'Editieren',
	'btn_config' => 'Konfigurieren',
	'btn_admin_section' => 'Admin Bereich',
	'btn_enable' => 'Modul aktivieren',
	'btn_disable' => 'Modul deaktivieren',
	'btn_modules' => 'Module',
	'btn_superuser' => 'Superuser',
	'btn_users' => 'Benutzer',
	'btn_groups' => 'Gruppen',
	'btn_login_as' => 'Einloggen als',
	'btn_login_as2' => 'Als %s einloggen',
	'btn_setup' => 'Neues Passwort setzen',
	'btn_login' => 'Einloggen',
	'btn_edit_user' => 'Benutzer editieren',
	'btn_cronjob' => 'Cronjob',
	'btn_defaults' => 'Reset',
	'btn_add_to_group' => 'Zu Gruppe hinzufügen',
	'btn_rem_from_group' => 'Aus Gruppe entfernen',
	'btn_user_groups' => '%s`s Gruppen editieren',
	'btn_add_to_grp' => 'Zu Gruppe hinzufügen',

	# Tooltips
	'tt_int' => 'Ganzzahl zwischen %s und %s.',
	'tt_text' => 'Zeichenkette mit der Länge %s bis %s.',
	'tt_bool' => 'Boolescher Wert.',
	'tt_script' => 'Skript Wert welcher ausschließlich vom Modul kontrolliert wird.',
	'tt_time' => 'Dauer zwischen %s und %s.<br/>Sie können auch Zeichenketten wie 1 year oder 1d 3m angeben.',
	'tt_float' => 'Fließkommazahl zwischen %s und %s.',

	#v2.01 (Add Group)
	'ft_add_group' => 'Eine Gruppe hinzufügen',
	'btn_add_group' => 'Gruppe hinzufügen',
	'msg_group_added' => 'Neue Gruppe wurde erzeugt.',
	'err_groupname' => 'Der Gruppenname ist ungültig. Er muss zwischen %s und %s Zeichen lang sein.',

	#v2.02 (refinish)
	'pi_install' => 'Das Modul %s hat %s Datenbank Tabellen:<br/>%s',
	'ft_install' => 'Das %s Modul installieren',
	'th_reinstall' => 'Datenbank Löschen und Neu Installieren',
	'err_no_admin_sect' => 'Dieses Modul hat keinen Admin Bereich.',
	'err_module' => 'Das Modul %s ist nicht vorhanden.',

	#v2.03 (creds+level)
	'th_user_credits' => '$',
	'th_user_level' => 'Level ',

	#v2.04 (drop wrapper)
	'ft_reinstall' => 'Modul %s neu installieren',
	'th_reset' => 'Modul Variablen zurücksetzen',

	#v2.05 (finish2)
	'btn_install_all' => 'Alle Module installieren',

	#v2.06 (GPG)
	'err_gpg_key' => 'Ihre GPG Signatur scheint ungültig zu sein.',
	'msg_gpg_key' => 'Bitte benutzen sie diesen Fingerprint in config.php: %s',

	#v2.07 (fix)
	'msg_edit_group' => 'Die Gruppe wurde bearbeitet.',
	'msg_mod_del' => 'Modul aus der Datenbank gelöscht.',
	'btn_delete' => 'Löschen',

	#monnino fixes
	'cfg_hide_web_spiders' => 'Hide Webspider',
	'cfg_install_webspiders' => 'Install Webspider',
	'btn_add' => 'Add group',
	
	#v2.09 (impersonation_alert)
	'mailt_impersonation' => GWF_SITENAME.': %s logged in as %s',
	'mailb_impersonation' =>
		"Dear %s,\n".
		"\n".
		"The admin user %s just used ´LoginAs´ to authenticate as %s.\n".
		"\n".
		"If you are this user you probably do not have to worry,\n".
		"especially if you recently reported a problem within ".GWF_SITENAME."\n".
		"If this is not the case and you are worried, please contact us!\n".
		"\n".
		'Kind Regards,'.PHP_EOL.
		'The '.GWF_SITENAME.' Robot'.PHP_EOL,
);
