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