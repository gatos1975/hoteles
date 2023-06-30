//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarUsuarios(e);
  });
}

$().ready(() => {
  cargaTablaUsuarios();
});
var cargaTablaUsuarios = () => {
  var html = "";
  $.post(
    "../../controllers/usuario.controller.php?op=todos",
    (listausuarios) => {
      listausuarios = JSON.parse(listausuarios);
      $.each(listausuarios, (index, usuario) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${usuario.Nombres}</td>` +
          `<td>${usuario.Apellidos}</td>` +
          `<td>${usuario.contrasenia}</td>` +
          `<td>${usuario.correo}</td>` +
          `<td>` +
          `<button class="btn btn-success btn-raised btn-xs" class="zmdi zmdi-refresh" onclick='uno(${usuario.idUsaurio})'>Editar</button>` +
          `<button class="btn btn-danger btn-raised btn-xs" class="zmdi zmdi-delete" onclick='eliminar(${usuario.idUsaurio})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};

/*var cargaSelectRoles = () => {
  var html = ' <option value="0">Seleccione una Opcion</option>';
  $.post("../../controllers/roles.controller.php?op=todos", (listaroles) => {
    listaroles = JSON.parse(listaroles);
    $.each(listaroles, (index, rol) => {
      html += `<option value="${rol.idRoles}">${rol.Detalle}</option>`;
    });
    $("#idRoles").html(html);
  });
};*/

var guardayeditarUsuarios = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var idUsaurio = document.getElementById("idUsaurio").value;
  if (idUsaurio === undefined || idUsaurio === "") {
    url = "../../controllers/usuario.controller.php?op=insertar";
  } else {
    url = "../../controllers/usuario.controller.php?op=actualizar";
  }
  /* for (var pair of form_Data.entries()) {
    console.log(pair[0] + ", " + pair[1]);
  }*/
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

var uno = (idUsaurio) => {
  $.post(
    "../../controllers/usuario.controller.php?op=uno",
    {
      idUsaurio: idUsaurio,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#idUsaurio").val(res.idUsaurio);
      $("#Nombres").val(res.Nombres);
      $("#Apellidos").val(res.Apellidos);
      $("#contrasenia").val(res.contrasenia);
      $("#correo").val(res.correo);
    }
  );
  document.getElementById("titulModalUsuarios").innerHTML = "Modificar Datos";
  $("#modalUsuarios").modal("show");
  //$("#modalUsuarios").show();
  //$("#new").show();
};
var eliminar = (idUsaurio) => {
  if (confirm("¿Está seguro de que desea eliminar?")) {
    $.post(
      "../../controllers/Usuario.controller.php?op=eliminar",
      {
        idUsaurio: idUsaurio,
      },
      (res) => {
        res = JSON.parse(res);
        if (res === "ok") {
          alert("Usuario eliminado con éxito");
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
/*
var eliminar = (idUsaurio) => {
  Swal.fire({
    title: "USUARIOS",
    text: "Esta seguro que desea eliminar...???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar!!!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/Usuario.controller.php?op=eliminar",
        {
          idUsaurio: idUsaurio,
        },
        (res) => {
          try {
            res = JSON.parse(res);
            if (res === "ok") {
              Swal.fire("Usuario", "Se eliminó con éxito", "success");
              limpiar();
              llenarTabla();
            } else {
              Swal.fire("Usuario", "NO Se eliminó", "success");
            }
          } catch (error) {
            console.log(error);
            Swal.fire(
              "Error",
              "Ocurrió un error al procesar la respuesta",
              "error"
            );
          }
        }
      );
    }
  });
};
*/
var limpiar = () => {
  document.getElementById("idUsaurio").value = "";
  document.getElementById("Nombres").value = "";
  $("#Apellidos").val("");
  $("#correo").val("");
  $("#contrasenia").val("");
  cargaTablaUsuarios();
  //$("#idRoles").val("0");

  //$("#modalUsuarios").modal("hide");

  $("#modalUsuarios").hide();
};
init();
