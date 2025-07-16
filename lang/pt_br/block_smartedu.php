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

$string['pluginname'] = 'SmartEdu – Aprendizado Inteligente';
$string['smartedu:addinstance'] = 'Adicione um novo bloco SmartEdu';
$string['smartedu:myaddinstance'] = 'Adicione um novo bloco SmartEdu à página Meu Moodle';
$string['termsofuse'] = 'Ao utilizar o bloco SmartEdu, você concorda com seus <a href="https://github.com/dired-ufla/moodle-block_smartedu/blob/main/terms-of-use.md" target="_blank">termos de uso</a>.';
$string['noresources'] = 'Não há <a href="https://github.com/dired-ufla/moodle-block_smartedu/blob/main/file-formats.md" target="_blank">arquivos compatíveis</a> para utilização neste curso.';
$string['aiprovider'] = "Escolha seu provedor de IA generativa";
$string['apikey'] = "Informe sua chave de API";
$string['localai:url'] = "Informe a URL do seu servidor local";
$string['localai:urlexample'] = "http://localhost:11434/api/chat";
$string['localai:model'] = "Informe o modelo do seu servidor local";
$string['localai:modelexample'] = "gemma3:4b";
$string['enablecache'] = "Habilitar cache de prompts";
$string['summarytype'] = "Tipo de resumo (para foruns e recursos)";
$string['nquestions'] = "Quantidade de questões";
$string['summarytype:simple'] = "Simples";
$string['summarytype:detailed'] = "Detalhado";
$string['studentinvisible'] = " - oculto para estudantes";
$string['resourcenotprocessable'] = "Não foi possível processar o conteúdo do recurso informado.";
$string['invalidtypefile'] = "Tipo de recurso não suportado.";
$string['invalidaiprovider'] = "Provedor de IA não suportado.";
$string['resourcenotfound'] = "Não foi possível encontrar o recurso informado.";
$string['internalerror'] = "Erro interno do sistema.";
$string['aiprovidererror'] = "Parece que houve um erro ao tentar usar o serviço de inteligência artificial. Por favor, tente novamente em alguns minutos. Se o problema persistir, entre em contato com o suporte.";
$string['generatestudyguide'] = "Gerar roteiro de estudo (para recursos)";
$string['generatemindmap'] = "Gerar mapa mental (para recursos)";
$string['quizz:question'] = "Questão ";
$string['quizz:showresponse'] = "Alternativa correta: ";
$string['quizz:sendresponses'] = "Corrigir";
$string['quizz:correct'] = "Parabéns! Você acertou!";
$string['quizz:wrong'] = "Não foi desta vez.";
$string['studyscript:title'] = "Roteiro de estudo";
$string['mindmap:title'] = "Mapa mental";
$string['prompt:simplesummary'] = 'Com base no seguinte conteúdo da aula intitulada "{$a}", escreva um resumo simples de no máximo 10 frases, destacando os principais conceitos abordados de forma objetiva e clara para um aluno de graduação. Retorne o resumo no seguinte formato: "summary": "Resumo da aula". ';
$string['prompt:detailedsummary'] = 'Com base no seguinte conteúdo da aula intitulada "{$a}", escreva um resumo detalhado de no máximo 20 frases, destacando e explicando os principais conceitos abordados para um aluno de graduação. Retorne o resumo no seguinte formato: "summary": "Resumo da aula". ';
$string['prompt:studyscript'] = 'Escreva também um roteiro de estudo para esta aula em HTML. Utilize a tag <h5> para títulos e <ul> para listas. Não utilize \n para quebras de linha. O roteiro deve conter o tema principal, os objetivos do texto, quais os assuntos que precisam ser aprendidos e o que o estudante deve ser capaz de saber após a leitura do texto. Retorne o guia de estudo no seguinte formato: "study_script": "Roteiro de estudo da aula". ';
$string['prompt:mindmap'] = 'Elabore também um mapa mental dos principais conceitos da aula, em um formato que possa ser lido corretamente pela biblioteca JavaScript MindElixir, e retorne o mapa mental conforme o seguinte exemplo: "mind_map": {"nodeData": {"id": "root", "topic": "root", "children": [{"id": "sub1", "topic": "sub1", "children": [{"id": "sub2", "topic": "sub2"}]}]}}. ';
$string['prompt:quizz'] = 'Elabore {$a} questões de múltipla escolha no formato JSON, com 4 alternativas (A, B, C, D), sendo apenas uma correta. Para cada alternativa, forneça uma breve explicação do porquê ela é correta ou incorreta, sem mencionar a palavra Correta ou Incorreta antes da explicação. Retorne as questões no seguinte formato: "questions": [{"question": "Texto da pergunta", "options": {"A": "Texto da alternativa A", "B": "Texto da alternativa B", "C": "Texto da alternativa C", "D": "Texto da alternativa D"}, "feedbacks": {"A": "Explicação da alternativa A", "B": "Explicação da alternativa B", "C": "Explicação da alternativa C", "D": "Explicação da alternativa D"}, "correct_option": "Letra da alternativa correta"}]. ';
$string['prompt:return'] = 'Reuna todos os resultados anteriores em um só arquivo no formato JSON entre chaves. Conteúdo da aula: {$a}';
$string['privacy:metadata'] = 'O bloco SmartEdu apenas exibe dados do curso já existentes.';
$string['prompt:simpleforum'] = 'Você vai receber uma série de discussões de um fórum em formato JSON, conforme o seguinte exemplo: [{"name": "Título da discussão do fórum", "content": "Mensagens do fórum relacionadas à discussão"}]. Sua tarefa escrever um resumo simples de no máximo 10 frases sobre o conteúdo das discussões e retornar um JSON no mesmo formato, destacando os principais pontos discutidos e as conclusões alcançadas. Mensagens do fórum: {$a}';
$string['prompt:detailedforum'] = 'Você vai receber uma série de discussões de um fórum em formato JSON, conforme o seguinte exemplo: [{"name": "Título da discussão do fórum", "content": "Mensagens do fórum relacionadas à discussão"}]. Sua tarefa escrever um resumo detalhado de no máximo 20 frases sobre o conteúdo das discussões e retornar um JSON no mesmo formato, destacando os principais pontos discutidos e as conclusões alcançadas. Mensagens do fórum: {$a}';
