<div class="container">
  <div class="row mt-3">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <?= $data['user']['name']; ?>
          </div>
          <div class="card-subtitle mb-2 text-muted">
            <?= $data['user']['email']; ?>
          </div>
          <a href="<?= BASE_URL; ?>" class="btn btn-sm btn-secondary mt-2">Back</a>
        </div>
      </div>
    </div>
  </div>
</div>