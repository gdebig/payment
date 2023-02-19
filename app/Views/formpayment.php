<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<main class="container">
    <div class="bg-light p-5 rounded">
        <h1><?= $pagetitle; ?></h1>
        <br />
        <form action="<?= base_url(); ?>dopayment" method="post">
            <div class="mb-3">
                <label for="paper_id" class="form-label">Paper ID *)</label>
                <input type="input" class="form-control" id="paper_id" name="paper_id" placeholder="Paper ID">
            </div>
            <div class="mb-3">
                <label for="paper_title" class="form-label">Paper Title *)</label>
                <textarea class="form-control" id="paper_title" name="paper_title" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="papper_authors" class="form-label">Paper Authors *)</label>
                <textarea class="form-control" id="paper_authors" name="paper_authors" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="payment_type" class="form-label">Type Payment *)</label>
                <select class="form-select" aria-label="Type Payment" name="payment_type" id="payment_type">
                    <option value="earlyRegIEEE" <?= $typepayment == "earlyRegIEEE" ? 'selected' : ''; ?>>(Early) Reguler IEEE Member (USD 225)</option>
                    <option value="earlyRegNonIEEE" <?= $typepayment == "earlyRegNonIEEE" ? 'selected' : ''; ?>>(Early) Reguler Non IEEE Member (USD 250)</option>
                    <option value="earlyStudentIEEE" <?= $typepayment == "earlyStudentIEEE" ? 'selected' : ''; ?>>(Early) Student IEEE Member (USD 125)</option>
                    <option value="earlyStudentNonIEEE" <?= $typepayment == "earlyStudentNonIEEE" ? 'selected' : ''; ?>>(Early) Student Non IEEE Member (USD 150)</option>
                    <option value="lateRegIEEE" <?= $typepayment == "lateRegIEEE" ? 'selected' : ''; ?>>(Late) Reguler IEEE Member (USD 275)</option>
                    <option value="lateRegNonIEEE" <?= $typepayment == "lateRegNonIEEE" ? 'selected' : ''; ?>>(Late) Reguler Non IEEE Member (USD 300)</option>
                    <option value="lateStudentIEEE" <?= $typepayment == "lateStudentIEEE" ? 'selected' : ''; ?>>(Late) Student IEEE Member (USD 175)</option>
                    <option value="lateStudentNonIEEE" <?= $typepayment == "lateStudentNonIEEE" ? 'selected' : ''; ?>>(Late) Student Non IEEE Member (USD 200)</option>
                    <option value="NonAuthor" <?= $typepayment == "NonAuthor" ? 'selected' : ''; ?>>Non-Author (USD 100)</option>
                </select>
            </div>
            <br />
            <div class="mb-3">
                <p>Note: Field with *) must be filled</p>
            </div>
            <br />
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="submit" id="submit" value="DoPayment">Do Payment</button>
                <button class="btn btn-danger" type="submit" name="submit" id="submit" value="Cancel">Cancel</button>
            </div>
        </form>
    </div>
</main>

<?= $this->endSection(); ?>