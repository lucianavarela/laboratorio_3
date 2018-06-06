console.log(data);

/*
    realizar las operaciones usando los metodos map,  reduce y filter y combinaciones entre ellos
  */


var soluciones = {};

console.log('Retornar un array con los nombres de los usuarios femeninos')

soluciones.usuariosFemeninos = function(usuarios){
    return usuarios
    .filter(function(user){
        return user.genero === 'Female';
    })
    .map(function(user){
        return user.nombre;
    });
}

console.log(soluciones.usuariosFemeninos(data));

console.log('Retornar un array de strings (el email de los usuarios de sexo masculino)');

soluciones.mailsVarones = function(usuarios){
    return usuarios
    .filter(function(user) {
        return user.genero == 'Male';
    })
    .map(function(user){
        return user.email;
    });
}

console.log(soluciones.mailsVarones(data));

console.log("Retornar un array de objetos que solo contengan las claves nombre, email y edad, de todos los usuarios mayores que 'edad'");

soluciones.usuariosMayores = function(usuarios, edad){
    return usuarios
    .filter(function(user) {
        return user.edad > edad;
    })
    .map(function(user) {
        return {
            'nombre': user.nombre,
            'email': user.email,
            'edad': user.edad
        }
    });
}

console.log(soluciones.usuariosMayores(data, 40));

console.log('Retornar un objeto que contenga solo el nombre y la edad del usuario mas grande.');

soluciones.usuarioMasGrande = function(usuarios){
    return usuarios
    .reduce(function(ant, actual) {
        if (ant.edad > actual.edad) {
            return {'nombre':ant.nombre, 'edad':ant.edad}
        } else {
            return {'nombre':actual.nombre, 'edad':actual.edad}
        }
    }, {'edad': 0});
}

console.log(soluciones.usuarioMasGrande(data));

console.log('Retornar el promedio de edad de los usuarios (number)');

soluciones.promedio = function(usuarios){
    var cantidad = usuarios.length;
    var acumEdad = usuarios
    .reduce(function(ant, actual) {
        return ant + actual.edad;
    }, 0);
    return (acumEdad/cantidad).toFixed(2);
}

console.log("Promedio edad usuarios " + soluciones.promedio(data));

console.log('Retornar el promedio de edad de los usuarios hombres (number)');

soluciones.promedioVarones = function(usuarios){
    var cantidad = 0;
    var acumEdad = usuarios
    .filter(function(user) {
        return user.genero == 'Male';
    })
    .reduce(function(ant, actual, index, array) {
        cantidad = array.length;
        return ant + actual.edad;
    }, 0);
    return (acumEdad/cantidad).toFixed(2);
}

console.log("Promedio edad Varones " + soluciones.promedioVarones(data));

console.log('Retornar el promedio de edad de los usuarios mujeres (number)');

soluciones.promedioMujeres = function(usuarios){
    var cantidad = 0;
    var acumEdad = usuarios
    .filter(function(user) {
        return user.genero == 'Female';
    })
    .reduce(function(ant, actual, index, array) {
        cantidad = array.length;
        return ant + actual.edad;
    }, 0);
    return (acumEdad/cantidad).toFixed(2);
}

console.log("Promedio edad Mujeres " + soluciones.promedioMujeres(data));
