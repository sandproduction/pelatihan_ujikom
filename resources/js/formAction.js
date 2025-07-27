function confirmDeleteData(event,data){        
    event.preventDefault();  // blokir submit form default
    event.stopPropagation();
    let confirm = document.getElementById('floating_confirm')
    if(confirm.value === `Hapus Data`){
        alert(`data ${data} dihapus`)
    }else{
        let notif = `<span class="font-sm text-red-500">Tulis Dengan Benar</span>`
        document.querySelector('[for="floating_confirm"]').insertAdjacentHTML('afterend', notif)
    }
}

document.getElementById('main-content').addEventListener('click', function(event){
    const id = event.target.id
    let formModalBody = document.getElementById("modal-body")
    console.log(dataBE)

    const csrfToken = "{{ csrf_token() }}";
    
    if(id.startsWith('btn-modal-anggota')){
        const formAction = "{{ route('anggota.store') }}";
        if(id.split('-')[3] !== 'delete'){
            formModalBody.innerHTML=`
             <form id="form-data" action="${formAction}" method="POST" class="max-w-md mx-auto">
                <input type="hidden" name="_token" value="${csrfToken}">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="nama" id="floating_nama" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_nama" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="alamat" id="floating_alamat" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_alamat" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="no_hp" id="floating_nohp" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_nohp" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nomor Handphone</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>                    
                <button id="btn-submit-form-modal" type="submit" class="bg-green-600 text-white px-3 py-2 rounded-md">Submit</button>
            </form>
            `
        }else if(id.split('-')[3] === 'delete'){
            formModalBody.innerHTML=`
                <div class="relative z-0 w-full mb-5 group">
                    <p>Apakah anda yakin ingin menghapus data ini?, klik <b>Hapus Data</b> dibawah</p>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_confirm" id="floating_confirm" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_confirm" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm</label>
                </div>
            `
            document.getElementById('form-data').dataset.formStat = 'delete'
            document.getElementById('form-data').dataset.idAnggota = id.split('-')[4]

            const btnHapusConfirm = document.getElementById('btn-submit-form-modal')

            btnHapusConfirm.classList.remove('bg-green-600')
            btnHapusConfirm.classList.add('bg-red-600')
            btnHapusConfirm.textContent = "Delete"
            btnHapusConfirm.dataset.idAnggota = id.split('-')[4]
        }

        if(id.split('-')[3] == 'edit'){
            document.getElementById('floating_nama')
            document.getElementById('floating_alamat')
            document.getElementById('floating_nohp')
            document.getElementById('floating_email')

            document.getElementById('btn-submit-form-modal').classList.remove('bg-green-600')
            document.getElementById('btn-submit-form-modal').classList.add('bg-blue-600')
            document.getElementById('btn-submit-form-modal').textContent = "Edit"
            document.getElementById('btn-submit-form-modal').removeAttribute('type')
        }

    }else if(id.startsWith('btn-modal-buku')){
        console.log(id)
       if(id.split('-')[3] !== 'delete'){
            formModalBody.innerHTML=`
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_judul" id="floating_judul" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_judul" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Judul</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_penulis" id="floating_penulis" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_penulis" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Penulis</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_penerbit" id="floating_penerbit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_penerbit" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Penerbit</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="floating_thnterbit" id="floating_thnterbit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_thnterbit" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tahun Terbit</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="floating_stok" id="floating_stok" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_stok" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Stok</label>
                </div>
            `
        }else if(id.split('-')[3] === 'delete'){
            formModalBody.innerHTML=`
                <div class="relative z-0 w-full mb-5 group">
                    <p>Apakah anda yakin ingin menghapus data ini?, klik <b>Hapus Data</b> dibawah</p>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_confirm" id="floating_confirm" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_confirm" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm</label>
                </div>
            `
            document.getElementById('form-data').dataset.formStat = 'delete'
            document.getElementById('form-data').dataset.idAnggota = id.split('-')[4]
            
            const btnHapusConfirm = document.getElementById('btn-submit-form-modal')

            btnHapusConfirm.classList.remove('bg-green-600')
            btnHapusConfirm.classList.add('bg-red-600')
            btnHapusConfirm.textContent = "Delete"
            btnHapusConfirm.dataset.idAnggota = id.split('-')[4]
        }

        if(id.split('-')[3] == 'edit'){
            document.querySelector('[name="floating_judul"]')
            document.querySelector('[name="floating_penulis"]')
            document.querySelector('[name="floating_penerbit"]')
            document.querySelector('[name="floating_thnterbit"]')
            document.querySelector('[name="floating_stok"]')

            document.getElementById('btn-submit-form-modal').classList.remove('bg-green-600')
            document.getElementById('btn-submit-form-modal').classList.add('bg-blue-600')
            document.getElementById('btn-submit-form-modal').textContent = "Edit"
            document.getElementById('btn-submit-form-modal').removeAttribute('type')
        }
    }else if(id.startsWith('btn-modal-peminjaman')){
       if(id.split('-')[3] !== 'delete'){
            formModalBody.innerHTML=`
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_anggota" id="floating_anggota" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_anggota" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Anggota</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_buku" id="floating_buku" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_buku" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Buku</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_tglpinjam" id="floating_tglpinjam" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_tglpinjam" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tanggal Pinjam</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_tglkembali" id="floating_tglkembali" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_tglkembali" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tanggal Kembali</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_status" id="floating_status" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_status" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label>
                </div>
            `
        }else if(id.split('-')[3] === 'delete'){
            formModalBody.innerHTML=`
                <div class="relative z-0 w-full mb-5 group">
                    <p>Apakah anda yakin ingin menghapus data ini?, klik <b>Hapus Data</b> dibawah</p>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_confirm" id="floating_confirm" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    
                    <label for="floating_confirm" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm</label>
                </div>
            `
            document.getElementById('form-data').dataset.formStat = 'delete'
            document.getElementById('form-data').dataset.idAnggota = id.split('-')[4]
            
            const btnHapusConfirm = document.getElementById('btn-submit-form-modal')

            btnHapusConfirm.classList.remove('bg-green-600')
            btnHapusConfirm.classList.add('bg-red-600')
            btnHapusConfirm.textContent = "Delete"
            btnHapusConfirm.dataset.idAnggota = id.split('-')[4]
        }

        if(id.split('-')[3] == 'edit'){
            document.querySelector('[name="floating_anggota"]')
            document.querySelector('[name="floating_buku"]')
            document.querySelector('[name="floating_tglpinjam"]')
            document.querySelector('[name="floating_tglkembali"]')
            document.querySelector('[name="floating_status"]')

            document.getElementById('btn-submit-form-modal').classList.remove('bg-green-600')
            document.getElementById('btn-submit-form-modal').classList.add('bg-blue-600')
            document.getElementById('btn-submit-form-modal').textContent = "Edit"
            document.getElementById('btn-submit-form-modal').removeAttribute('type')
        }
    }
    document.getElementById('form-data').addEventListener('submit', function(event) {
    if(event.target.dataset.formStat){
        event.preventDefault(); // cegah submit
        event.stopPropagation();
        let confirmInput = document.getElementById('floating_confirm');
        let value = confirmInput.value.trim();
        
        // Hapus notifikasi lama kalau ada
        let existingNotif = document.getElementById('confirm-delete-false')
        if (existingNotif) existingNotif.classList.add('hidden');
    
        if (value.toLowerCase() === 'hapus data') {
            console.log(event.target)
            alert(`data dihapus ${event.target.dataset.idAnggota}`);
            // Jika memang ingin submit form setelah validasi, aktifkan ini:
            this.submit();
        } else {
            document.getElementById('confirm-delete-false').classList.remove('hidden')
        }
    }
});
})