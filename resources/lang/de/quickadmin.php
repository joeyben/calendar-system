<?php

return [
	
	'user-management' => [
		'title' => 'User management',
		'fields' => [
		],
	],
	
	'roles' => [
		'title' => 'Roles',
		'fields' => [
			'title' => 'Title',
		],
	],
	
	'users' => [
		'title' => 'Users',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Passwort',
			'role' => 'Role',
			'remember-token' => 'Remember token',
		],
	],
	
	'countries' => [
		'title' => 'Countries',
		'fields' => [
			'shortcode' => 'Shortcode',
			'title' => 'Title',
			'name' => 'Name',
		],
	],
	
	'customers' => [
		'title' => 'Kunden',
		'fields' => [
			'first-name' => 'Vorname',
			'last-name' => 'Nachname',
			'address' => 'Adresse',
			'phone' => 'Tel',
			'email' => 'E-Mail',
			'country' => 'Land',
		],
	],
	
	'rooms' => [
		'title' => 'Objekte',
		'fields' => [
            'name' => 'Objektname',
            'room-number' => 'Objektnummer',
			'floor' => 'Max Personen',
			'description' => 'Beschreibung',
		],
	],
	
	'bookings' => [
		'title' => 'Buchungen',
		'fields' => [
			'customer' => 'Kunde',
			'room' => 'Objekt',
			'time-from' => 'Time from',
			'time-to' => 'Time to',
			'additional-information' => 'Additional information',
		],
	],

    'history' => [
        'title' => 'History',
        'fields' => [
            'icon' => '-',
            'user' => 'Benutzer',
            'type' => 'Type',
            'type_' => [
                'Booking' => 'Buchung',
                'Customer' => 'Kunde',
                'Room' => 'Objekt',
            ],
            'time' => 'Wann',
            'day' => 'Datum',
            'text' => 'Text',
        ],
    ],

	'find-room' => [
		'title' => 'Find Objekt',
		'fields' => [
		],
	],
	'qa_create' => 'Erstellen',
	'qa_save' => 'Speichern',
	'qa_edit' => 'Bearbeiten',
	'qa_view' => 'Anschauen',
	'qa_update' => 'Aktualisieren',
	'qa_list' => 'Report',
	'qa_no_entries_in_table' => 'Keine Einträge in der Tabelle.',
	'qa_custom_controller_index' => 'Custom controller index.',
	'qa_logout' => 'Abmelden',
	'qa_add_new' => 'Hinzufügen',
	'qa_are_you_sure' => 'Sind Sie sicher?',
	'qa_back_to_list' => 'Zurück zur Liste',
	'qa_dashboard' => 'Dashboard',
	'qa_delete' => 'Löschen',
	'qa_restore' => 'Wiederherstellen',
	'qa_permadel' => 'Permant löschen',
	'qa_all' => 'Alle',
	'qa_trash' => 'Papierkorb',
	'qa_delete_selected' => 'Markierte löschen',
	'qa_category' => 'Kategorie',
	'qa_categories' => 'Kategorien',
	'qa_sample_category' => 'Beispielkategorie',
	'qa_questions' => 'Fragen',
	'qa_question' => 'Frage',
	'qa_answer' => 'Antwort',
	'qa_sample_question' => 'Beispielfrage',
	'qa_sample_answer' => 'Beispielantwort',
	'qa_faq_management' => 'FAQ Verwaltung',
	'qa_administrator_can_create_other_users' => 'Administrator (kann andere Benutzer erstellen)',
	'qa_simple_user' => 'Einfacher Benutzer',
	'qa_title' => 'Titel',
	'qa_roles' => 'Rollen',
	'qa_role' => 'Rolle',
	'qa_user_management' => 'Benutzerverwaltung',
	'qa_users' => 'Benutzer',
	'qa_user' => 'Benutzer',
	'qa_name' => 'Name',
	'qa_email' => 'E-Mail',
	'qa_password' => 'Passwort',
	'qa_remember_token' => 'Remember Token',
	'qa_permissions' => 'Zugriffsrechte',
	'qa_user_actions' => 'Prokoll',
	'qa_action' => 'Action',
	'qa_action_model' => 'Action Model',
	'qa_action_id' => 'Action ID',
	'qa_time' => 'Zeit',
	'qa_campaign' => 'Kampagne',
	'qa_campaigns' => 'Kampagnen',
	'qa_description' => 'Beschreibung',
	'qa_valid_from' => 'Gültig von',
	'qa_valid_to' => 'Gültig bis',
	'qa_discount_amount' => 'Rabattbetrag',
	'qa_discount_percent' => 'Rabatt in Prozent',
	'qa_coupons_amount' => 'Anzahl Gutscheine',
	'qa_coupons' => 'Gutscheine',
	'qa_code' => 'Code',
	'qa_redeem_time' => 'Eingelöst',
	'qa_coupon_management' => 'Gutscheinverwaltung',
	'qa_time_management' => 'Zeiterfassung',
	'qa_projects' => 'Projekte',
	'qa_reports' => 'Berichte',
	'qa_time_entries' => 'Zeiterfassungseinträge',
	'qa_work_type' => 'Art der Arbeit',
	'qa_work_types' => 'Arten der Arbeit',
	'qa_project' => 'Projekt',
	'qa_start_time' => 'Beginnt am',
	'qa_end_time' => 'Endet am',
	'qa_expense_category' => 'Asugabenkategorie',
	'qa_expense_categories' => 'Ausgabenkategorien',
	'qa_expense_management' => 'Ausgabenverwaltung',
	'qa_expenses' => 'Ausgaben',
	'qa_expense' => 'Ausgabe',
	'qa_entry_date' => 'Erfasst am',
	'qa_amount' => 'Betrag',
	'qa_income_categories' => 'Einnahmenkategorien',
	'qa_monthly_report' => 'Monatsbericht',
	'qa_companies' => 'Firmen',
	'qa_company_name' => 'Firmenname',
	'qa_address' => 'Adresse',
	'qa_website' => 'Webseite',
	'qa_contact_management' => 'Kontaktverwaltung',
	'qa_contacts' => 'Kontakte',
	'qa_company' => 'Firma',
	'qa_first_name' => 'Vorname',
	'qa_last_name' => 'Nachname',
	'qa_phone' => 'Telefon',
	'qa_phone1' => 'Telefon 1',
	'qa_phone2' => 'Telefon 2',
	'qa_skype' => 'Skype',
	'qa_photo' => 'Foto (max. 8 MB)',
	'qa_category_name' => 'Kategoriename',
	'qa_product_management' => 'Produktverwaltung',
	'qa_products' => 'Produkte',
	'qa_product_name' => 'Produktname',
	'qa_price' => 'Preis',
	'qa_tags' => 'Stichwörter',
	'qa_tag' => 'Stichwort',
	'qa_photo1' => 'Abbildung 1',
	'qa_photo2' => 'Abbildung 2',
	'qa_photo3' => 'Abbildung 3',
	'qa_calendar' => 'Kalender',
	'qa_statuses' => 'Stati',
	'qa_task_management' => 'Aufgabenplanung',
	'qa_tasks' => 'Aufgabe',
	'qa_status' => 'Status',
	'qa_attachment' => 'Anhang',
	'qa_due_date' => 'Frist',
	'qa_assigned_to' => 'Zugewiesen zu',
	'qa_assets' => 'Geräte',
	'qa_asset' => 'Gerät',
	'qa_serial_number' => 'Seriennummer',
	'qa_location' => 'Standort',
	'qa_locations' => 'Standorte',
	'qa_assigned_user' => 'Benutzer',
	'qa_notes' => 'Notizen',
	'qa_assets_history' => 'Verlauf',
	'qa_assets_management' => 'Geräteverwaltung',
	'qa_slug' => 'Slug',
	'qa_content_management' => 'Inhaltsverwaltung',
	'qa_text' => 'Text',
	'qa_excerpt' => 'Auszug',
	'qa_featured_image' => 'Hauptbild',
	'qa_pages' => 'Seiten',
	'qa_axis' => 'Achse',
	'qa_show' => 'Zeige',
	'qa_group_by' => 'Gruppiere nach',
	'qa_chart_type' => 'Diagrammtyp',
	'qa_create_new_report' => 'Erzeuge neuen Bericht',
	'qa_no_reports_yet' => 'Keine berichte',
	'qa_created_at' => 'Erstellt am',
	'qa_updated_at' => 'Aktualisiert am',
	'qa_deleted_at' => 'Gelöscht am',
	'qa_reports_x_axis_field' => 'X-Achse - bitte wählen sie ein Datums oder Zeitfeld',
	'qa_reports_y_axis_field' => 'Y-Achse - bitte wählen sie ein Zahlenfeld',
	'qa_select_crud_placeholder' => 'Bitte wählen sie einen CRUD',
	'qa_select_dt_placeholder' => 'Bitte wählen sie ein Datums oder Zeitfeld',
	'qa_aggregate_function_use' => 'Aggregate Funktion',
	'qa_x_axis_group_by' => 'X-Achse gruppieren nach',
	'qa_x_axis_field' => 'X-Achsen Feld (Datum/Zeit)',
	'qa_y_axis_field' => 'Y-Achsen Feld',
	'qa_integer_float_placeholder' => 'Bitte wählen Sie ein Zahlen Feld',
	'qa_change_notifications_field_1_label' => 'Sende Benachrichtigung an Benutzer',
	'qa_change_notifications_field_2_label' => 'Wenn Eintrag in CRUD',
	'qa_select_users_placeholder' => 'Bitte wählen sie einen Benutzer',
	'qa_is_created' => 'ist erstellt',
	'qa_is_updated' => 'ist aktualisiert',
	'qa_is_deleted' => 'ist gelöscht',
	'qa_notifications' => 'Benachrichtigungen',
	'qa_notify_user' => 'Benachrichtige Benutzer',
	'qa_when_crud' => 'Wenn CRUDD',
	'qa_create_new_notification' => 'Erstelle Benachrichtigung',
	'qa_stripe_transactions' => 'Stripe Transaktionen',
	'qa_upgrade_to_premium' => 'Zu Premium heraufstufen',
	'qa_messages' => 'Nachrichten',
	'qa_you_have_no_messages' => 'Sie haben keine Nachrichten.',
	'qa_all_messages' => 'Alle Nachrichten',
	'qa_new_message' => 'Neue Nachricht',
	'qa_outbox' => 'Gesendet',
	'qa_inbox' => 'Posteingang',
	'qa_recipient' => 'Empfänger',
	'qa_subject' => 'Betreff',
	'qa_message' => 'Nachricht',
	'qa_send' => 'Senden',
	'qa_reply' => 'Antworten',
	'qa_calendar_sources' => 'Kalenderquellen',
	'qa_new_calendar_source' => 'Erstelle eine neue Kalenderquelle',
	'qa_crud_title' => 'Crud Titel',
	'qa_crud_date_field' => 'Crud Datumsfeld',
	'qa_prefix' => 'Prefix',
	'qa_label_field' => 'Beschreibungsfeld',
	'qa_suffix' => 'Suffix',
	'qa_no_calendar_sources' => 'Keine Kalenderquellen',
	'qa_crud_event_field' => 'Ereignis-Beschreibungsfeld',
	'qa_create_new_calendar_source' => 'Erstelle neue Kalenderquelle',
	'qa_edit_calendar_source' => 'Kalenderquelle bearbeiten',
	'qa_client_management' => 'Kundenverwaltung',
	'qa_client_management_settings' => 'Kundenverwaltung-Einstellungen',
	'qa_country' => 'Land',
	'qa_client_status' => 'Kundenstatus',
	'qa_clients' => 'Kunden',
	'qa_client_statuses' => 'Kundenstati',
	'qa_currencies' => 'Währungen',
	'qa_main_currency' => 'Hauptwährung',
	'qa_documents' => 'Dokumente',
	'qa_file' => 'Datei',
	'qa_income_source' => 'Einnahmequelle',
	'qa_income_sources' => 'Einnahmequellen',
	'qa_fee_percent' => 'Gebühren in Prozent',
	'qa_note_text' => 'Text der Notiz',
	'qa_client' => 'Kunde',
	'qa_start_date' => 'Beginnt am',
	'qa_budget' => 'Budget',
	'qa_project_status' => 'Projektstatus',
	'qa_project_statuses' => 'Projektstati',
	'qa_transactions' => 'Transaktionen',
	'qa_transaction_types' => 'Transaktionstypen',
	'qa_transaction_type' => 'Transaktionstyp',
	'qa_transaction_date' => 'Transaktionsdatum',
	'qa_currency' => 'Währung',
	'qa_current_password' => 'Aktuelles Passwort',
	'qa_new_password' => 'Neues Passwort',
	'qa_password_confirm' => 'Passwort wiederholen',
	'qa_dashboard_text' => 'Sie sind angemeldet!',
	'qa_forgot_password' => 'Passwort vergessen?',
	'qa_remember_me' => 'Anmeldedaten merken',
	'qa_login' => 'Anmelden',
	'qa_change_password' => 'Passwört ändern',
	'qa_csv' => 'CSV',
	'qa_print' => 'Drucken',
	'qa_excel' => 'Excel',
	'qa_copy' => 'Kopieren',
	'qa_colvis' => 'Spaltensichtbarkeit',
	'qa_pdf' => 'PDF',
	'qa_reset_password' => 'Passwort zurücksetzen',
	'qa_reset_password_woops' => '<strong>Uuups!</strong> Fehlerhafte Eingabe:',
	'qa_email_line1' => 'Sie erhalten diese E-Mail weil wir eine Passwort zurücksetzen Anfrage erhalten haben.',
	'qa_email_line2' => 'Wenn sie keine Passwort zurücksetzen Anfrage gesendet haben, brauchen sie nichts unternehmen.',
	'qa_email_greet' => 'Hallo',
	'qa_email_regards' => 'Grüße',
	'qa_confirm_password' => 'Passwort bestätigen',
	'qa_if_you_are_having_trouble' => 'Wenn sie Probleme mit dem drücken des',
	'qa_copy_paste_url_bellow' => 'Buttons haben, kopieren sie den Link in ihren Browser:',
	'qa_please_select' => 'Bitte auswählen',
	'qa_register' => 'Registrieren',
	'qa_registration' => 'Registrierung',
	'qa_not_approved_title' => 'Sie sind nicht freigeschaltet',
	'qa_not_approved_p' => 'Ihr Konto wurde noch nicht von einem Administrator freigeschaltet. Bitte gedulden sie sich und versuchen sie es später noch einmal.',
	'qa_there_were_problems_with_input' => 'Es gab Probleme mit der Eingabe',
	'qa_whoops' => 'Uuups!',
	'qa_file_contains_header_row' => 'Datei enthält eine Kopfzeile?',
	'qa_csvImport' => 'CSV Importieren',
	'qa_csv_file_to_import' => 'Datei für den CSV Import',
	'qa_parse_csv' => 'Lese CSV',
	'qa_import_data' => 'Daten importieren',
	'qa_imported_rows_to_table' => ':rows Zeilen in Tabelle :table importiert',
	'quickadmin_title' => 'Kalender',
];