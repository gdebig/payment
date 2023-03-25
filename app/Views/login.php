<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<main class="container">
    <div class="bg-light p-5 rounded">

        <?php if (session()->getFlashdata('err')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('err') ?></div>
        <?php endif; ?>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <h1><?= $pagetitle; ?></h1>
        <form action="<?= base_url(); ?>auth" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username *)</label>
                <input type="input" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password *)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <br />
            <div class="mb-3">
                <p>Note: Field with *) must be filled</p>
            </div>
            <br />
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="submit" id="submit" value="login">Login</button>
                <button class="btn btn-danger" type="submit" name="submit" id="submit" value="cancel">Cancel</button>
            </div>
        </form>
    </div>
</main>

<?= $this->endSection(); ?>