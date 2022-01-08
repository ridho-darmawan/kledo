petunjuk pengujian rest-api

1. clone project
2. silakan composer install
3. create nama db : kledo-app
4. silakan migration database

API
1. pegawai
    1. menampilkan seluruh data pegawai => (GET) http://localhost:8000/api/pegawai
    2.menambah data pegawai => (POST) http://localhost:8000/api/pegawai
                             => variable input (nama,gaji)
2. gaji pegawai
    1. data semua gaji pegawai = > (GET) http://localhost:8000/api/gaji-pegawai
    2. filter berdasarkan tahun dan bulan => (GET) http://localhost:8000/api/gaji-pegawai?tahun=2022&bulan=01
    3.  memasukkan data gaji pegawai, untuk salah satu pegawai => (POST) http://localhost:8000/api/gaji-pegawai
                                                               => varible input (pegawai_id)
    4. Memasukkan data gaji pegawai, untuk semua pegawai yang ada > (POST) http://localhost:8000/api/gaji-pegawai/batch                                                           
