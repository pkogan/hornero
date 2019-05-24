Blockly.JavaScript['parametro'] = function(block) {
  var value_parametronumero = Blockly.JavaScript.valueToCode(block, 'parametroNumero', Blockly.JavaScript.ORDER_ATOMIC);
  // TODO: Assemble JavaScript into code variable.
  var code = 'parseInt(parametros['+value_parametronumero+'])';
  // TODO: Change ORDER_NONE to the correct strength.
  return [code, Blockly.JavaScript.ORDER_NONE];
};

Blockly.JavaScript['respuesta'] = function(block) {
  var value_respuesta = Blockly.JavaScript.valueToCode(block, 'respuesta', Blockly.JavaScript.ORDER_ATOMIC);
  // TODO: Assemble JavaScript into code variable.
  var code = 'respuesta ='+value_respuesta;;
  return code;
};