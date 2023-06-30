//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html

function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarClientes(e);
  });
}

$().ready(() => {
  cargaTablaRoles();
});

/*var cargaTablaRoles = () => {
    var html = "";
    $.post(
      "../../controllers/clientes.controller.php?op=todos",
      (listaclientes) => {
        listaclientes = JSON.parse(listaclientes);
        $.each(listaclientes, (index, clientes) => {
          html +=
            `<tr>` +
            `<td>${index + 1}</td>` +
            `<td>${clientes.nombres}</td>` +
            `<td>${clientes.telefono}</td>` +
            `<td>` +
            `<button class='btn btn-success' onclick='uno(${habitaciones.idhabitacion})'>RESERVAR</button>` +
            `<button class='btn btn-danger' onclick='eliminar(${habitaciones.idhabitacion})'>Eliminar</button>` +
            `</td>` +
            `</tr>`;
        });
        $("#TablaUsuarios").html(html);
      }
    );
  };*/

var cargaSelectHoteles = () => {
  var html = ' <option value="0">Seleccione una Opcion</option>';
  $.post(
    "../../controllers/hoteles.controller.php?op=todos",
    (listahoteles) => {
      listahoteles = JSON.parse(listahoteles);
      $.each(listahoteles, (index, hoteles) => {
        html += `<option value="${hoteles.idHotel}">${hoteles.nombre}</option>`;
      });
      $("#idHotel").html(html);
    }
  );
};
var guardayeditarClientes = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var idusuario = document.getElementById("idusuario").value;
  if (idusuario === undefined || idusuario === "") {
    url = "../../controllers/clientes.controller.php?op=insertar";
  } else {
    url = "../../controllers/clientes.controller.php?op=actualizar";
  }
  //for (var pair of form_Data.entries()) {
  // console.log(pair[0] + ", " + pair[1]);
  //}
  //var form_data = new FormData($("#usuarios_form")[0]);
  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        alert("LA RESERVACION FUE ENVIAD CON EXITO");
        limpiar();
        //cargaTablaUsuarios();
      } else {
        limpiar();
        //cargaTablaUsuarios();
        //alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var uno = (idusuario) => {
  $.post(
    "../../controllers/usuario.controller.php?op=uno",
    {
      idhabitacion: idhabitacion,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#idhabitacion").val(res.idhabitacion);
      $("#numero").val(res.numero);
      $("#descripcion").val(res.descripcion);
      $("#nombre").val(res.nombre);
      $("#ciudad").val(res.ciudad);
    }
  );
  document.getElementById("titulModalUsuarios").innerHTML = "Modificar Datos";
  $("#modalUsuarios").modal("show");
  //$("#modalUsuarios").show();
  //$("#new").show();
};
var eliminar = (idhabitacion) => {
  if (confirm("¿Está seguro de que desea eliminar?")) {
    $.post(
      "../../controllers/habitaciones.controller.php?op=eliminar",
      {
        idhabitacion: idhabitacion,
      },
      (res) => {
        res = JSON.parse(res);
        if (res === "ok") {
          alert("Hotel eliminado con éxito");
          limpiar();
          cargaTablaUsuarios();
          //llenarTabla();
        } else {
          alert("No se pudo eliminar el usuario");
        }
      }
    );
  }
};

var limpiar = () => {
  document.getElementById("idusuario").value = "";
  document.getElementById("nombres").value = "";
  $("#telefono").val("");
  cargaTablaUsuarios();
  //$("#idRoles").val("0");

  //$("#modalUsuarios").modal("hide");

  $("#modalUsuarios").hide();
};
init();
