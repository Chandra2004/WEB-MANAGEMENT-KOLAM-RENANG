1. Kelompok Akses & Keamanan (Induk Utama)
roles(uid) → role_has_permissions(role_uid) (OK)

permissions(uid) → role_has_permissions(permission_uid) (OK)

roles(uid) → model_has_roles(role_uid) (OK)

users(uid) → model_has_roles(model_uid) (OK)

users(uid) → reset_token(email) (Relasi via data email) (OK)

users(uid) → notifications(uid_user) (OK)

users(uid) → logs_activity(uid_user) (OK)

users(uid) → social_medias(uid_user) (OK)

2. Kelompok Profil & Klub
users(uid) → data_users(uid) (OK)

clubs(uid) → data_users(uid_club) (OK)

3. Kelompok Manajemen Event & Kategori
events(uid) → event_categories(uid_event) (OK)

events(uid) → document(uid_event) (OK)

events(uid) → galleries(uid_event) (kosong)

categories(uid) → event_categories(uid_category) (OK)

event_categories(uid) → category_requirements(uid_event_category) (ok)

4. Kelompok Operasional & Pendaftaran
users(uid) → registrations(uid_user) (OK)

event_categories(uid) → registrations(uid_event_category) (OK)

5. Kelompok Hasil & Transaksi (Anak dari Pendaftaran)
registrations(uid) → shchedules(uid_registration) (OK)

registrations(uid) → payments(uid_registration) (OK)

registrations(uid) → results(uid_registration) (OK)