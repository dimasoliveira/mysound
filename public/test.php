<html lang="en"><head>
  <meta charset="UTF-8">
  <title>Materialize-autocomplete demo</title>  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>

  <style>
    .autocomplete {
      display: -ms-flexbox;
      display: flex;
    }
    .autocomplete .ac-users {
      padding-top: 10px;
    }
    .autocomplete .ac-users .chip {
      -ms-flex: auto;
      flex: auto;
      margin-bottom: 10px;
      margin-right: 10px;
    }
    .autocomplete .ac-users .chip:last-child {
      margin-right: 5px;
    }
    .autocomplete .ac-dropdown .ac-hover {
      background: #eee;
    }
    .autocomplete .ac-input {
      -ms-flex: 1;
      flex: 1;
      min-width: 150px;
      padding-top: 0.6rem;
    }
    .autocomplete .ac-input input {
      height: 2.4rem;
    }
  </style>
</head>
<body cz-shortcut-listen="true">
<div class="container">
  <div class="row">
    <h1 class="col s12">Materialize-autocomplete</h1>
    <form class="col s12" _lpchecked="1">
      <div class="row">
        <div class="input-field col s12">
          <div class="autocomplete" id="single">
            <div class="ac-input">
              <ul class="ac-appender"></ul><input type="text" id="singleInput" placeholder="Please input some letters" data-activates="singleDropdown" data-beloworigin="true" autocomplete="off"><ul id="singleDropdown" class="dropdown-content ac-dropdown"></ul>
              <input type="hidden" class="validate"></div>

          </div>
          <label class="active" for="singleInput">Single autocomplete: </label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <div class="autocomplete" id="multiple">
            <div class="ac-users ac-appender"></div>
            <div class="ac-input">
              <input type="text" id="multipleInput" placeholder="Please input some letters" data-activates="multipleDropdown" data-beloworigin="true" autocomplete="off" class=""><ul id="multipleDropdown" class="dropdown-content ac-dropdown" style="width: 1280px; position: absolute; top: 45px; left: 11.25px; opacity: 1; display: none;"></ul>
              <input type="hidden" class="validate" value=""></div>

            <input type="hidden" name="multipleHidden">
          </div>
          <label class="active" for="multipleInput">Multiple autocomplete: </label>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="https://icefox0801.github.io/materialize-autocomplete/jquery.materialize-autocomplete.js"></script>
<script>var autocomplete = $('#el').materialize_autocomplete({
    limit: 20,
    multiple: {
      enable: true,
      maxSize: 10,
      onExist: function (item) { /* ... */ },
      onExceed: function (maxSize, item) { /* ... */ }
    },
    appender: {
      el: '#someEl'
    },
    getData: function (value, callback) {
      // ...
      callback(value,  [{ 'id': 'Abe', 'text': 'Abe'}, {'id': 'Ari', 'text': 'Ari'},
        {'id': 'Baz','text': 'Baz'},{'id': 'Baz','text': 'Baz'},{'id': 'Baz','text': 'Baz'},{'id': 'Abe','text': 'Abe'},{'id': 'Abe','text': 'Abe'},{'id': 'Ari','text': 'Ari'},{'id': 'Ari','text': 'Ari'}]);




    }
  });</script>
<script>
  $(function () {

    var multiple = $('#multipleInput').materialize_autocomplete({
      multiple: {
        enable: true
      },
      appender: {
        el: '.ac-users'
      },
      dropdown: {
        el: '#multipleDropdown'
      }
    });

    var resultCache = {
      'A': [
        {
          id: 'Abe',
          text: 'Abe'
        },
        {
          id: 'Ari',
          text: 'Ari'
        }
      ],
      'B': [
        {
          id: 'Baz',
          text: 'Baz'
        }
      ],
      'BA': [
        {
          id: 'Baz',
          text: 'Baz'
        }
      ],
      'BAZ': [
        {
          id: 'Baz',
          text: 'Baz'
        }
      ],
      'AB': [
        {
          id: 'Abe',
          text: 'Abe'
        }
      ],
      'ABE': [
        {
          id: 'Abe',
          text: 'Abe'
        }
      ],
      'AR': [
        {
          id: 'Ari',
          text: 'Ari'
        }
      ],
      'ARI': [
        {
          id: 'Ari',
          text: 'Ari'
        }
      ]
    };

    single.resultCache = resultCache;
    multiple.resultCache = resultCache;
  });
</script>

<div class="hiddendiv common"></div><div id="toast-container"></div></body></html>