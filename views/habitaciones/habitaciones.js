//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarHabitaciones(e);
  });
}
$().ready(() => {
  cargaTablaRoles();
});
var cargaTablaRoles = () => {
  var html = "";
  $.post(
    //"../../controllers/usuario.controller.php?op=todos",
    "../../controllers/habitaciones.controller.php?op=todos",
    (listahabitaciones) => {
      listahabitaciones = JSON.parse(listahabitaciones);
      $.each(listahabitaciones, (index, habitaciones) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${habitaciones.numero}</td>` +
          `<td>${habitaciones.descripcion}</td>` +
          `<td>${habitaciones.nombre}</td>` +
          `<td>${habitaciones.ciudad}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${habitaciones.idhabitacion})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${habitaciones.idhabitacion})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};
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
var guardayeditarHabitaciones = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var idhabitacion = document.getElementById("idhabitacion").value;
  if (idhabitacion === undefined || idhabitacion === "") {
    url = "../../controllers/habitaciones.controller.php?op=insertar";
  } else {
    url = "../../controllers/habitaciones.controller.php?op=actualizar";
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
        alert("Se guardo con exito");
        limpiar();
        cargaTablaUsuarios();
      } else {
        limpiar();
        cargaTablaUsuarios();
        //alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var uno = (idhabitacion) => {
  $.post(
    "../../controllers/habitaciones.controller.php?op=uno",
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
  document.getElementById("idhabitacion").value = "";
  document.getElementById("numero").value = "";
  $("#descripcion").val("");

  cargaTablaUsuarios();
  //$("#idRoles").val("0");

  //$("#modalUsuarios").modal("hide");

  $("#modalUsuarios").hide();
};
init();
