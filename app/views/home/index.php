<div class="container">
  <div class="row mt-3">
    <div class="col-md-6">
      <?= Flashdata::flash(); ?>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUser">
        Add User
      </button>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <form action="<?= BASE_URL; ?>/home/search" method="POST">
        <div class="input-group">
          <input autocomplete="off" type="text" id="keyword" name="keyword" placeholder="User name" class="form-control">
          <div class="input-group-append">
            <button type="submit" class="btn btn-outline-primary">
              Search
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <h2 class="ml-1">Users</h2>
      <ul class="list-group">
        <?php foreach ($data['users'] as $user) : ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div><?= $user['name']; ?></div>
            <div>
              <a href="<?= BASE_URL; ?>/home/detail/<?= $user['id']; ?>" class="badge badge-primary">
                detail
              </a>
              <button class="js-delete btn badge badge-warning" data-id="<?= $user['id']; ?>" data-toggle="modal" data-target="#addUser">
                edit
              </button>
              <a onclick="return confirm('Are you sure want to remove?')" href="<?= BASE_URL; ?>/home/delete/<?= $user['id']; ?>" class="badge badge-danger">
                delete
              </a>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="add-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="false">&times;</span>
        </button>
      </div>
      <form action="<?= BASE_URL; ?>/home/create" method="POST">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>