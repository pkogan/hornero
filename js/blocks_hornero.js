Blockly.Blocks['parametro'] = {
  init: function() {
    this.appendValueInput("parametroNumero")
        .setCheck("Number")
        .appendField("Parámetro Número");
    this.setOutput(true, null);
    this.setColour(230);
 this.setTooltip("Parámetro de hornero");
 this.setHelpUrl("");
  }
};

Blockly.Blocks['respuesta'] = {
  init: function() {
    this.appendValueInput("respuesta")
        .setCheck(null)
        .appendField("respuesta");
    this.setColour(230);
 this.setTooltip("");
 this.setHelpUrl("");
  }
};

Blockly.Blocks['retorna'] = {
  init: function() {
    this.appendValueInput("respuesta")
        .setCheck(null)
        .appendField("Retorna");
    this.setPreviousStatement(true, null);
    this.setColour(230);
 this.setTooltip("Salida");
 this.setHelpUrl("Salida");
  }
};

Blockly.Blocks['entrada'] = {
  init: function() {
    this.appendValueInput("Entrada")
        .setCheck("Number")
        .appendField("Entrada");
    this.setOutput(true, null);
    this.setColour(230);
 this.setTooltip("entrada");
 this.setHelpUrl("entrada");
  }
};