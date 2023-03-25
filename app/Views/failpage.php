<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<main class="container">
    <div class="bg-light p-5 rounded">

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('err')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('err') ?></div>
        <?php endif; ?>

        <h1><?= $pagetitle; ?></h1>
        <p>Your payment is failed. Please re-proceed the payment.</p>
        <a class="btn btn-lg btn-primary" href="<?= base_url(); ?>" role="button">Back to Home &raquo;</a>
    </div>
</main>

<?= $this->endSection(); ?>