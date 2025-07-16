<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Languages configuration for the block_smartedu plugin.
 *
 * @package   block_smartedu
 * @copyright 2025, Paulo Júnior <pauloa.junior@ufla.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'SmartEdu – Aprendizaje Inteligente';
$string['smartedu:addinstance'] = 'Agregar un nuevo bloque SmartEdu';
$string['smartedu:myaddinstance'] = 'Agregar un nuevo bloque SmartEdu a la página Mi Moodle';
$string['termsofuse'] = 'Al utilizar el bloque SmartEdu, aceptas sus <a href="https://github.com/dired-ufla/moodle-block_smartedu/blob/main/terms-of-use.md" target="_blank">Términos de uso</a>.';
$string['noresources'] = 'No hay <a href="https://github.com/dired-ufla/moodle-block_smartedu/blob/main/file-formats.md" target="_blank">archivos compatibles</a> disponibles para este curso.';
$string['aiprovider'] = "Elija su proveedor de IA Generativa";
$string['apikey'] = "Ingrese su clave API";
$string['localai:url'] = "Ingrese la URL de su servidor local";
$string['localai:urlexample'] = "http://localhost:11434/api/chat";
$string['localai:model'] = "Ingrese el modelo de su servidor local";
$string['localai:modelexample'] = "gemma3:4b";
$string['enablecache'] = "Habilitar caché de prompts";
$string['summarytype'] = "Tipo de resumen (para foros y recursos)";
$string['nquestions'] = "Número de preguntas";
$string['summarytype:simple'] = "Simple";
$string['summarytype:detailed'] = "Detallado";
$string['studentinvisible'] = " - oculto para los estudiantes";
$string['resourcenotfound'] = "No se pudo encontrar el recurso especificado.";
$string['resourcenotprocessable'] = "No se pudo procesar el contenido del recurso especificado.";
$string['invalidtypefile'] = "Tipo de recurso no compatible.";
$string['invalidaiprovider'] = "Proveedor de IA no compatible.";
$string['aiprovidererror'] = "Parece que ocurrió un error al intentar utilizar el servicio de IA. Por favor, inténtelo de nuevo en unos minutos. Si el problema persiste, contacte al soporte.";
$string['internalerror'] = "Error interno del sistema.";
$string['generatestudyguide'] = "Generar guía de estudio (para recursos)";
$string['generatemindmap'] = "Generar mapa mental (para recursos)";
$string['quizz:question'] = "Pregunta ";
$string['quizz:showresponse'] = "La respuesta correcta es: ";
$string['quizz:sendresponses'] = "Enviar respuestas";
$string['quizz:correct'] = "Respuesta correcta";
$string['quizz:wrong'] = "Respuesta incorrecta";
$string['studyscript:title'] = "Guía de estudio";
$string['mindmap:title'] = "Mapa mental";
$string['prompt:simplesummary'] = 'Con base en el siguiente contenido de la clase titulada "{$a}", redacta un resumen simple de no más de 10 oraciones, destacando los conceptos principales de forma clara y objetiva para un estudiante de grado. Devuelve el resumen en el siguiente formato: "summary": "Resumen de la clase". ';
$string['prompt:detailedsummary'] = 'Con base en el siguiente contenido de la clase titulada "{$a}", redacta un resumen detallado de no más de 20 oraciones, destacando y explicando los conceptos principales para un estudiante de grado. Devuelve el resumen en el siguiente formato: "summary": "Resumen de la clase". ';
$string['prompt:studyscript'] = 'Además, redacta una guía de estudio para esta clase que contenga el tema principal, los objetivos del texto, los temas que se deben aprender y lo que el estudiante debería ser capaz de comprender después de leer el texto. Devuelve la guía de estudio en el siguiente formato: "study_script": "Guía de estudio de la clase". ';
$string['prompt:mindmap'] = 'Además, crea un mapa mental de los conceptos principales de la clase, en un formato que pueda ser leído correctamente por la biblioteca JavaScript MindElixir, y devuelve el mapa mental en el siguiente formato: "mind_map": {"nodeData": {"id": "root", "topic": "root", "children": [{"id": "sub1", "topic": "sub1", "children": [{"id": "sub2", "topic": "sub2"}]}]}}. ';
$string['prompt:quizz'] = 'Crea {$a} preguntas de opción múltiple en formato JSON, con 4 opciones (A, B, C, D), de las cuales solo una es correcta. Para cada opción, proporciona una breve explicación de por qué es correcta o incorrecta, sin utilizar las palabras Correcta o Incorrecta antes de la explicación. Devuelve las preguntas en el siguiente formato: "questions": [{"question": "Texto de la pregunta", "options": {"A": "Texto de la opción A", "B": "Texto de la opción B", "C": "Texto de la opción C", "D": "Texto de la opción D"}, "feedbacks": {"A": "Explicación de la opción A", "B": "Explicación de la opción B", "C": "Explicación de la opción C", "D": "Explicación de la opción D"}, "correct_option": "Letra de la opción correcta"}]. ';
$string['prompt:return'] = 'Reúne todos los resultados anteriores en un único archivo en formato JSON encerrado entre llaves. Contenido de la clase: {$a}';
$string['privacy:metadata'] = 'El bloque SmartEdu solo muestra datos existentes del curso.';
$string['prompt:simpleforum'] = 'Recibirás una serie de discusiones de foro en formato JSON, como se muestra en el siguiente ejemplo: [{"name": "Título de la discusión del foro", "content": "Mensajes del foro relacionados con la discusión"}]. Tu tarea es redactar un resumen simple de no más de 10 oraciones sobre el contenido de las discusiones y devolver un JSON en el mismo formato, destacando los puntos principales debatidos y las conclusiones alcanzadas. Mensajes del foro: {$a}';
$string['prompt:detailedforum'] = 'Recibirás una serie de discusiones de foro en formato JSON, como se muestra en el siguiente ejemplo: [{"name": "Título de la discusión del foro", "content": "Mensajes del foro relacionados con la discusión"}]. Tu tarea es redactar un resumen detallado de no más de 20 oraciones sobre el contenido de las discusiones y devolver un JSON en el mismo formato, destacando los puntos principales debatidos y las conclusiones alcanzadas. Mensajes del foro: {$a}';
