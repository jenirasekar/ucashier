<div class="container-fluid p-2">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-title m-auto p-2">
                    <h5 style="font-weight: bold"><?php echo e($title); ?></h5>
                </div>
                <div class="card-body">
                    <a href="/admin/produk/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>

                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-success mt-2"><i class="fas fa-check"></i>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->nama); ?></td>
                                    <td><?php echo e($item->id_kategori); ?></td>
                                    <td><?php echo e($item->harga); ?></td>
                                    <td><?php echo e($item->stok); ?></td>
                                    <td><img src="<?php echo e(Storage::url('public/produk/') . $item->gambar); ?>" alt="" style="width: 100px;"></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/admin/kategori/<?php echo e($item->id); ?>/edit"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="<?php echo e(route('admin.kategori.destroy', $item->id)); ?>"
                                                method="post">
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-danger btn-sm ml-1" type="submit"
                                                    onclick="return confirm('Apakah Anda yakin?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\ucashier\resources\views/admin/produk/index.blade.php ENDPATH**/ ?>