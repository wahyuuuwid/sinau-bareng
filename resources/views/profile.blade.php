<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f0f0f0; padding: 30px; }
        .container { max-width: 560px; margin: auto; }

        h1 { font-size: 22px; font-weight: 600; margin-bottom: 4px; }
        .subtitle { font-size: 14px; color: #666; margin-bottom: 20px; }

        .profile-card {
            background: #fff;
            border: 1.5px solid #4a90d9;
            border-radius: 10px;
            padding: 20px 24px;
        }

        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #333; }
        .field-row { display: flex; align-items: center; gap: 12px; }
        .field-value {
            flex: 1;
            background: #f0f0f0;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 14px;
            font-style: italic;
            color: #333;
        }

        .btn-link {
            display: flex; align-items: center; gap: 5px;
            background: none; border: none; cursor: pointer;
            font-size: 13px; color: #666; white-space: nowrap;
            padding: 0;
        }
        .btn-link:hover { color: #333; }
        .btn-link svg { width: 15px; height: 15px; flex-shrink: 0; }

        .card-footer {
            border-top: 1px solid #e5e5e5;
            padding-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-password {
            display: flex; align-items: center; gap: 6px;
            background: none; border: none; cursor: pointer;
            font-size: 13px; font-weight: 600; color: #333; padding: 0;
        }
        .btn-password svg { width: 16px; height: 16px; }
        .btn-hapus {
            display: flex; align-items: center; gap: 6px;
            background: none; border: none; cursor: pointer;
            font-size: 13px; font-weight: 600; color: #e53e3e; padding: 0;
        }
        .btn-hapus svg { width: 16px; height: 16px; }

        .alert { padding: 10px 14px; border-radius: 8px; margin-bottom: 16px; font-size: 13px; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

        .modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.45);
            justify-content: center; align-items: center;
            z-index: 999;
        }
        .modal-overlay.active { display: flex; }
        .modal-box {
            background: #fff;
            border-radius: 10px;
            padding: 24px;
            max-width: 340px; width: 90%;
        }
        .modal-box h3 { font-size: 15px; font-weight: 600; margin-bottom: 8px; }
        .modal-box p { font-size: 13px; color: #555; margin-bottom: 20px; }
        .modal-actions { display: flex; gap: 8px; justify-content: flex-end; }
        .btn-cancel {
            padding: 7px 16px; border-radius: 6px;
            border: 1px solid #ccc; background: none;
            font-size: 13px; cursor: pointer;
        }
        .btn-confirm-delete {
            padding: 7px 16px; border-radius: 6px;
            border: none; background: #fee2e2;
            color: #e53e3e; font-size: 13px;
            font-weight: 600; cursor: pointer;
        }
        .modal-form input[type="text"],
        .modal-form input[type="email"] {
            width: 100%; padding: 8px 12px;
            border: 1px solid #ccc; border-radius: 6px;
            font-size: 14px; margin-bottom: 12px;
        }
        .btn-save {
            padding: 7px 16px; border-radius: 6px;
            border: none; background: #3b82f6;
            color: #fff; font-size: 13px;
            font-weight: 600; cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $err) <div>{{ $err }}</div> @endforeach
        </div>
    @endif

    <h1>Profil</h1>
    <p class="subtitle">Kelola akun anda</p>

    <div class="profile-card">

        <div class="field">
            <label>Nama Lengkap</label>
            <div class="field-row">
                <div class="field-value">{{ $user->name }}</div>
                <button type="button" class="btn-link" onclick="document.getElementById('modalNama').classList.add('active')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/></svg>
                    ubah nama
                </button>
            </div>
        </div>

        <div class="field">
            <label>Email</label>
            <div class="field-row">
                <div class="field-value">{{ $user->email }}</div>
                <button type="button" class="btn-link" onclick="document.getElementById('modalEmail').classList.add('active')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/></svg>
                    ubah alamat email
                </button>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn-password" onclick="window.location='{{ route('password.change') }}'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572C2.561 13.074 2.561 10.576 4.317 10.15a1.724 1.724 0 001.066-2.573C4.443 6.034 6.209 4.267 7.753 5.207a1.724 1.724 0 002.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Kelola Kata Sandi
            </button>
            <button type="button" class="btn-hapus" onclick="document.getElementById('modalHapus').classList.add('active')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Hapus Akun
            </button>
        </div>
    </div>
</div>

{{-- Modal Ubah Nama --}}
<div class="modal-overlay" id="modalNama">
    <div class="modal-box modal-form">
        <h3>Ubah Nama</h3>
        <form action="{{ route('profile.updateName') }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama baru" required>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('modalNama').classList.remove('active')">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Ubah Email --}}
<div class="modal-overlay" id="modalEmail">
    <div class="modal-box modal-form">
        <h3>Ubah Email</h3>
        <form action="{{ route('profile.updateEmail') }}" method="POST">
            @csrf
            <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email baru" required>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="document.getElementById('modalEmail').classList.remove('active')">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Konfirmasi Hapus Akun --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal-box">
        <h3>Hapus Akun?</h3>
        <p>Akun yang dihapus tidak dapat dipulihkan. Apakah kamu yakin?</p>
        <div class="modal-actions">
            <button type="button" class="btn-cancel" onclick="document.getElementById('modalHapus').classList.remove('active')">Batal</button>
            <form action="{{ route('profile.delete') }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-confirm-delete">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
