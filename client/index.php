<?php

  include '../config/connect.php';

  $mysql = "SELECT * From `list` ORDER BY position ASC";
  // $mysql = "SELECT * From `list`";

  $query = $pdo->prepare($mysql);
  $query->execute();

  $todos = $query->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Todo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" />
  </head>
  <body>


    <!-- messages -->
    <?php if (isset($_GET['msg'])){ ?>
      <?php if ($_GET['msg'] == 'updated'){ ?>
          <h3 class="container mt-3 alert alert-success">You update a todo.</h3>
      <?php } elseif ($_GET['msg'] == 'created'){?>
          <h3 class="container mt-3 alert alert-success">You created a todo.</h3>
      <?php } ?>
    <?php } ?>

    <div class="container">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#exampleModal1">
        Create Todo
      </button>


      <!-- Modal create todo -->
      <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Todo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="mt-1" action="../backend/todos.php" method="post">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@Name</span>
                  </div>
                  <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">@Descriptions</span>
                  </div>
                  <input type="text" class="form-control" name="description" placeholder="Descriptions" aria-label="Descriptions" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@Options</label>
                  </div>
                  <select class="custom-select" name="priority" id="inputGroupSelect01">
                    <option value="low" selected>Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">@Deadline</span>
                  </div>
                  <input type="date" name="date" class="form-control" aria-label="Deadline" min="2019-06-12" max="2119-12-31" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                  <input type="submit" name="submit" value="Submit" class="btn btn-secondary btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- all todo -->
      <ul class="list-group mt-4" id='sortable'>
        <?php foreach ($todos as $todo): ?>
          <li class="list-group-item" id="<?php echo $todo['id'] ?>">
            <?php if (!$todo['done']){ ?>
              <span>
                <input type="checkbox" class='done' data-id="<?php echo $todo['id'] ?>">
              </span>
            <?php }else{ ?>
              <span>
                <input type="checkbox" class='done' data-id="<?php echo $todo['id'] ?>" checked>
              </span>
            <?php } ?>
            <span data-id="<?php echo $todo['id'] ?>" data-toggle="modal" data-target="#exampleModal3" id='descriptions'><?php echo $todo['name'] ?></span>
            <button type="button" data-id="<?php echo $todo['id'] ?>" data-toggle="modal" data-target="#exampleModal2" id='example' style="float:right;cursor: pointer;">
                    <span class="oi oi-list"></span>
            </button>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Modal update todo -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Todo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="mt-1" action="../backend/updatedtodo.php" method="post">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@Name</span>
                </div>
                <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1" id="todoName" required>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">@Descriptions</span>
                </div>
                <input type="text" class="form-control" name="description" placeholder="Descriptions" aria-label="Descriptions" aria-describedby="basic-addon1" id="todoDescriptions" required>
              </div>
              <div class="input-group mb-3" id="todoPriority">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">@Options</label>
                </div>
                <select class="custom-select" name="priority" id="inputGroupSelect01" required>
                  <option value="low">Low</option>
                  <option value="medium">Medium</option>
                  <option value="high">High</option>
                </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon2">@Deadline</span>
                </div>
                <input type="date" name="date" class="form-control" aria-label="Deadline" min="2019-06-12" max="2119-12-31" aria-describedby="basic-addon1" id="todoDeadline" required>
              </div>
              <div class="input-group mb-3">
                <input type="hidden" name="id" value="" id='hiddenTodo'>
                <input type="submit" name="submit" value="Update" class="btn btn-secondary btn-block">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal details todo -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="col-10 modal-title text-center" id="detailName"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-3 mt-3">
                <label>Description:</label>
              </div>
              <div class="col-9 mt-3">
                <h4 id='detailDescription'></h4>
              </div>
              <div class="col-3 mt-3">
                <label>Deadline:</label>
              </div>
              <div class="col-9 mt-3">
                <h4 id='detailDeadline'></h4>
              </div>
              <div class="col-3 mt-3">
                <label>Priority:</label>
              </div>
              <div class="col-9 mt-3">
                <h4 id='detailPriority'></h4>
              </div>
              <hr>
            </div>
            <br>
            <form action="../backend/deletetodo.php" method="post">
              <input type="hidden" name="id" value="" id='detailId'>
              <button type="submit" class="btn btn-danger btn-block" name="button">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../javascript/todo.js" charset="utf-8"></script>
  </body>
</html>
