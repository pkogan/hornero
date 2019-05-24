<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="google" value="notranslate">
        <title>Cliente hornero Blocky:</title>
        <link rel="stylesheet" href="js/style.css">
<!--        <script src="/storage.js"></script>-->
        <script src="js/blockly_compressed.js"></script>
        <script src="js/blocks_compressed.js"></script>
        <script src="js/blocks_hornero.js"></script>
        
        
        <script src="js/javascript_compressed.js"></script>
        <script src="js/generator_hornero.js"></script>
<!--        <script src="../../python_compressed.js"></script>
        <script src="../../php_compressed.js"></script>
        <script src="../../lua_compressed.js"></script>
        <script src="../../dart_compressed.js"></script>-->
        <script src="js/code.js"></script>
    </head>
    <body>
        <table width="100%" height="100%">
            <tr>
                <td>
                    <h1><a href="http://hornero.fi.uncoma.edu.ar">hornero</a>&rlm; &gt;
                        <a href="../index.html">Blockly</a>&rlm; &gt;
                        <span id="title">...</span>
                    </h1>
                    token=<input type="text" id="token" value="">
                    problema=<input type="text" id="problema" value="">
                </td>
                <td class="farSide">
                    
                    <select id="languageMenu"></select>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <table width="100%">
                        <tr id="tabRow" height="1em">
                            <td class="tabmin">&nbsp;</td>
                            <td id="tab_enun" class="taboff">Enunciado</td>
                            <td class="tabmin">&nbsp;</td>
                            <td id="tab_blocks" class="tabon">...</td>
                            <td class="tabmin">&nbsp;</td>
                            <td id="tab_pseint" class="taboff">Pseudocódigo</td>
                            
                            <td class="tabmin">&nbsp;</td>
                            <td id="tab_javascript" class="taboff">JavaScript</td>
                            <td class="tabmin">&nbsp;</td>
                            <td id="tab_python" class="taboff">Python</td>
                            <td class="tabmin">&nbsp;</td>
                            <td id="tab_php" class="taboff">PHP</td>
                            <td class="tabmin">&nbsp;</td>
<!--                            <td id="tab_lua" class="taboff">Lua</td>
                            <td class="tabmin">&nbsp;</td>
                            <td id="tab_dart" class="taboff">Dart</td>
                            <td class="tabmin">&nbsp;</td>-->
                            <td id="tab_xml" class="taboff">XML</td>
                            <td class="tabmax">
                                <button id="trashButton" class="notext" title="...">
                                    <img src='js/media/1x1.gif' class="trash icon21">
                                </button>
                                <button id="linkButton" class="notext" title="...">
                                    <img src='js/media/1x1.gif' class="link icon21">
                                </button>
                                <button id="runHorneroButton" class="notext " title="Guardar">
                                    <img src='js/media/1x1.gif' class="link icon21">
                                </button>
                                <button id="runButton" class="notext primary" title="...">
                                    <img src='js/media/1x1.gif' class="run icon21">
                                </button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="99%" width="80%" id="content_area">
                </td>
                <td height="99%" width="20%" >
                    <p class="tabon">Salida</p>
                    <hr/>
            
                    <div class="pln" id="content_salida"></div>
                
                </td>
                
            </tr>
        </table>
        <div id="content_blocks" class="content"></div>
        <pre id="content_pseint" class="content"></pre>
        <pre id="content_javascript" class="content"></pre>
        <pre id="content_python" class="content"></pre>
        <pre id="content_php" class="content"></pre>
        <pre id="content_lua" class="content"></pre>
        <pre id="content_dart" class="content"></pre>
        <textarea id="content_xml" class="content" wrap="off"></textarea>
        

    <xml id="toolbox" style="display: none">
        <category name="hornero" colour="#5b6da5">
            <block type="parametro"></block>
            <block type="respuesta"></block>
        </category>
        <category name="%{BKY_CATLOGIC}" colour="%{BKY_LOGIC_HUE}">
            <block type="controls_if"></block>
            <block type="logic_compare"></block>
            <block type="logic_operation"></block>
            <block type="logic_negate"></block>
            <block type="logic_boolean"></block>
            <block type="logic_null"></block>
            <block type="logic_ternary"></block>
        </category>
        <category name="%{BKY_CATLOOPS}" colour="%{BKY_LOOPS_HUE}">
            <block type="controls_repeat_ext">
                <value name="TIMES">
                    <shadow type="math_number">
                        <field name="NUM">10</field>
                    </shadow>
                </value>
            </block>
            <block type="controls_whileUntil"></block>
            <block type="controls_for">
                <value name="FROM">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
                <value name="TO">
                    <shadow type="math_number">
                        <field name="NUM">10</field>
                    </shadow>
                </value>
                <value name="BY">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
            </block>
            <block type="controls_forEach"></block>
            <block type="controls_flow_statements"></block>
        </category>
        <category name="%{BKY_CATMATH}" colour="%{BKY_MATH_HUE}">
            <block type="math_number">
                <field name="NUM">123</field>
            </block>
            <block type="math_arithmetic">
                <value name="A">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
                <value name="B">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
            </block>
            <block type="math_single">
                <value name="NUM">
                    <shadow type="math_number">
                        <field name="NUM">9</field>
                    </shadow>
                </value>
            </block>
            <block type="math_trig">
                <value name="NUM">
                    <shadow type="math_number">
                        <field name="NUM">45</field>
                    </shadow>
                </value>
            </block>
            <block type="math_constant"></block>
            <block type="math_number_property">
                <value name="NUMBER_TO_CHECK">
                    <shadow type="math_number">
                        <field name="NUM">0</field>
                    </shadow>
                </value>
            </block>
            <block type="math_round">
                <value name="NUM">
                    <shadow type="math_number">
                        <field name="NUM">3.1</field>
                    </shadow>
                </value>
            </block>
            <block type="math_on_list"></block>
            <block type="math_modulo">
                <value name="DIVIDEND">
                    <shadow type="math_number">
                        <field name="NUM">64</field>
                    </shadow>
                </value>
                <value name="DIVISOR">
                    <shadow type="math_number">
                        <field name="NUM">10</field>
                    </shadow>
                </value>
            </block>
            <block type="math_constrain">
                <value name="VALUE">
                    <shadow type="math_number">
                        <field name="NUM">50</field>
                    </shadow>
                </value>
                <value name="LOW">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
                <value name="HIGH">
                    <shadow type="math_number">
                        <field name="NUM">100</field>
                    </shadow>
                </value>
            </block>
            <block type="math_random_int">
                <value name="FROM">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
                <value name="TO">
                    <shadow type="math_number">
                        <field name="NUM">100</field>
                    </shadow>
                </value>
            </block>
            <block type="math_random_float"></block>
            <block type="math_atan2">
                <value name="X">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
                <value name="Y">
                    <shadow type="math_number">
                        <field name="NUM">1</field>
                    </shadow>
                </value>
            </block>
        </category>
        <category name="%{BKY_CATTEXT}" colour="%{BKY_TEXTS_HUE}">
            <block type="text"></block>
            <block type="text_join"></block>
            <block type="text_append">
                <value name="TEXT">
                    <shadow type="text"></shadow>
                </value>
            </block>
            <block type="text_length">
                <value name="VALUE">
                    <shadow type="text">
                        <field name="TEXT">abc</field>
                    </shadow>
                </value>
            </block>
            <block type="text_isEmpty">
                <value name="VALUE">
                    <shadow type="text">
                        <field name="TEXT"></field>
                    </shadow>
                </value>
            </block>
            <block type="text_indexOf">
                <value name="VALUE">
                    <block type="variables_get">
                        <field name="VAR">{textVariable}</field>
                    </block>
                </value>
                <value name="FIND">
                    <shadow type="text">
                        <field name="TEXT">abc</field>
                    </shadow>
                </value>
            </block>
            <block type="text_charAt">
                <value name="VALUE">
                    <block type="variables_get">
                        <field name="VAR">{textVariable}</field>
                    </block>
                </value>
            </block>
            <block type="text_getSubstring">
                <value name="STRING">
                    <block type="variables_get">
                        <field name="VAR">{textVariable}</field>
                    </block>
                </value>
            </block>
            <block type="text_changeCase">
                <value name="TEXT">
                    <shadow type="text">
                        <field name="TEXT">abc</field>
                    </shadow>
                </value>
            </block>
            <block type="text_trim">
                <value name="TEXT">
                    <shadow type="text">
                        <field name="TEXT">abc</field>
                    </shadow>
                </value>
            </block>
            <block type="text_print">
                <value name="TEXT">
                    <shadow type="text">
                        <field name="TEXT">abc</field>
                    </shadow>
                </value>
            </block>
            <block type="text_prompt_ext">
                <value name="TEXT">
                    <shadow type="text">
                        <field name="TEXT">abc</field>
                    </shadow>
                </value>
            </block>
        </category>
        <category name="%{BKY_CATLISTS}" colour="%{BKY_LISTS_HUE}">
            <block type="lists_create_with">
                <mutation items="0"></mutation>
            </block>
            <block type="lists_create_with"></block>
            <block type="lists_repeat">
                <value name="NUM">
                    <shadow type="math_number">
                        <field name="NUM">5</field>
                    </shadow>
                </value>
            </block>
            <block type="lists_length"></block>
            <block type="lists_isEmpty"></block>
            <block type="lists_indexOf">
                <value name="VALUE">
                    <block type="variables_get">
                        <field name="VAR">{listVariable}</field>
                    </block>
                </value>
            </block>
            <block type="lists_getIndex">
                <value name="VALUE">
                    <block type="variables_get">
                        <field name="VAR">{listVariable}</field>
                    </block>
                </value>
            </block>
            <block type="lists_setIndex">
                <value name="LIST">
                    <block type="variables_get">
                        <field name="VAR">{listVariable}</field>
                    </block>
                </value>
            </block>
            <block type="lists_getSublist">
                <value name="LIST">
                    <block type="variables_get">
                        <field name="VAR">{listVariable}</field>
                    </block>
                </value>
            </block>
            <block type="lists_split">
                <value name="DELIM">
                    <shadow type="text">
                        <field name="TEXT">,</field>
                    </shadow>
                </value>
            </block>
            <block type="lists_sort"></block>
        </category>
        <category name="%{BKY_CATCOLOUR}" colour="%{BKY_COLOUR_HUE}">
            <block type="colour_picker"></block>
            <block type="colour_random"></block>
            <block type="colour_rgb">
                <value name="RED">
                    <shadow type="math_number">
                        <field name="NUM">100</field>
                    </shadow>
                </value>
                <value name="GREEN">
                    <shadow type="math_number">
                        <field name="NUM">50</field>
                    </shadow>
                </value>
                <value name="BLUE">
                    <shadow type="math_number">
                        <field name="NUM">0</field>
                    </shadow>
                </value>
            </block>
            <block type="colour_blend">
                <value name="COLOUR1">
                    <shadow type="colour_picker">
                        <field name="COLOUR">#ff0000</field>
                    </shadow>
                </value>
                <value name="COLOUR2">
                    <shadow type="colour_picker">
                        <field name="COLOUR">#3333ff</field>
                    </shadow>
                </value>
                <value name="RATIO">
                    <shadow type="math_number">
                        <field name="NUM">0.5</field>
                    </shadow>
                </value>
            </block>
        </category>
        <sep></sep>
        <category name="%{BKY_CATVARIABLES}" colour="%{BKY_VARIABLES_HUE}" custom="VARIABLE"></category>
        <category name="%{BKY_CATFUNCTIONS}" colour="%{BKY_PROCEDURES_HUE}" custom="PROCEDURE"></category>
        
    </xml>

</body>
</html>