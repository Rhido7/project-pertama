<template>
    <div>
        <input
            type="text"
            v-model="search"
            placeholder="Cari produk..."
            class="form-control mb-3"
        />
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(produk, index) in filteredProduks" :key="produk.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ produk.nama }}</td>
                    <td>{{ produk.kategori ? produk.kategori.nama : '-' }}</td>
                    <td>Rp {{ produk.harga.toLocaleString('id-ID') }}</td>
                    <td>{{ produk.stok }}</td>
                    <td>
                        <a :href="'/produk/' + produk.id + '/edit'" class="btn btn-warning btn-sm">Edit</a>
                        <form :action="'/produk/' + produk.id" method="POST" style="display:inline">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <tr v-if="filteredProduks.length === 0">
                    <td colspan="6" class="text-center">Produk tidak ditemukan</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['produks', 'csrf'],
    data() {
        return {
            search: ''
        }
    },
    computed: {
        filteredProduks() {
            return this.produks.filter(p =>
                p.nama.toLowerCase().includes(this.search.toLowerCase()) ||
                (p.kategori && p.kategori.nama.toLowerCase().includes(this.search.toLowerCase()))
            );
        }
    }
}
</script>