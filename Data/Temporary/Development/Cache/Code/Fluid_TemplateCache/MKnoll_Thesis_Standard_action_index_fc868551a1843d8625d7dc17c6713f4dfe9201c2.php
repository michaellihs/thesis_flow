<?php
class FluidCache_MKnoll_Thesis_Standard_action_index_fc868551a1843d8625d7dc17c6713f4dfe9201c2 extends \TYPO3\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getVariableContainer() {
	// TODO
	return new \TYPO3\Fluid\Core\ViewHelper\TemplateVariableContainer();
}
public function getLayoutName(\TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {

return 'Default';
}
public function hasLayout() {
return TRUE;
}

/**
 * section Title
 */
public function section_768e0c1c69573fb588f61f1308a015c11468e05f(\TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;

return 'Hierarchical Recommender';
}
/**
 * section Content
 */
public function section_4f9be057f0ea5d2ba72fd2c810e8d7b9aa98b469(\TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '

    <header class="jumbotron masthead">
        <div class="inner">
            <h1>Hierarchical Recommender</h1>

            <p>Hierarchische Dokumentensuche</p>

            ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\FormViewHelper
$arguments1 = array();
$arguments1['action'] = 'search';
$arguments1['method'] = 'post';
$arguments1['style'] = 'text-align: center';
$arguments1['class'] = 'well form-search';
$arguments1['additionalAttributes'] = NULL;
$arguments1['arguments'] = array (
);
$arguments1['controller'] = NULL;
$arguments1['package'] = NULL;
$arguments1['subpackage'] = NULL;
$arguments1['object'] = NULL;
$arguments1['section'] = '';
$arguments1['format'] = '';
$arguments1['additionalParams'] = array (
);
$arguments1['absolute'] = false;
$arguments1['addQueryString'] = false;
$arguments1['argumentsToBeExcludedFromQueryString'] = array (
);
$arguments1['fieldNamePrefix'] = NULL;
$arguments1['actionUri'] = NULL;
$arguments1['objectName'] = NULL;
$arguments1['enctype'] = NULL;
$arguments1['name'] = NULL;
$arguments1['onreset'] = NULL;
$arguments1['onsubmit'] = NULL;
$arguments1['dir'] = NULL;
$arguments1['id'] = NULL;
$arguments1['lang'] = NULL;
$arguments1['title'] = NULL;
$arguments1['accesskey'] = NULL;
$arguments1['tabindex'] = NULL;
$arguments1['onclick'] = NULL;
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
$output3 = '';

$output3 .= '
                ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper
$arguments4 = array();
$arguments4['id'] = 'searchPhraseAutoComplete';
$arguments4['class'] = 'input-xxlarge btn-large search-query';
$arguments4['name'] = 'phrase';
$arguments4['additionalAttributes'] = NULL;
$arguments4['required'] = NULL;
$arguments4['type'] = 'text';
$arguments4['placeholder'] = NULL;
$arguments4['value'] = NULL;
$arguments4['property'] = NULL;
$arguments4['disabled'] = NULL;
$arguments4['maxlength'] = NULL;
$arguments4['readonly'] = NULL;
$arguments4['size'] = NULL;
$arguments4['errorClass'] = 'f3-form-error';
$arguments4['dir'] = NULL;
$arguments4['lang'] = NULL;
$arguments4['style'] = NULL;
$arguments4['title'] = NULL;
$arguments4['accesskey'] = NULL;
$arguments4['tabindex'] = NULL;
$arguments4['onclick'] = NULL;
$renderChildrenClosure5 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper6 = $self->getViewHelper('$viewHelper6', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper');
$viewHelper6->setArguments($arguments4);
$viewHelper6->setRenderingContext($renderingContext);
$viewHelper6->setRenderChildrenClosure($renderChildrenClosure5);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper

$output3 .= $viewHelper6->initializeArgumentsAndRender();

$output3 .= '
                <button type="submit" class="btn btn-primary btn-large">Suchen</button>
            ';
return $output3;
};
$viewHelper7 = $self->getViewHelper('$viewHelper7', $renderingContext, 'TYPO3\Fluid\ViewHelpers\FormViewHelper');
$viewHelper7->setArguments($arguments1);
$viewHelper7->setRenderingContext($renderingContext);
$viewHelper7->setRenderChildrenClosure($renderChildrenClosure2);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\FormViewHelper

$output0 .= $viewHelper7->initializeArgumentsAndRender();

$output0 .= '

        </div>
    </header>


    <script type="text/javascript">
        $(function() {

            $( "#searchPhraseAutoComplete" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "http://thesis.centos.localhost/mknoll.thesis/standard/autocomplete",
                        dataType: "json",
                        data: {
                            phrase: request.term
                        },
                        success: function( data ) {
                            response( $.map( data.results, function( item ) {
                                return {
                                    label: item.title + (item.docId),
                                    value: item.docId
                                }
                            }));
                        }
                    });
                },
                minLength: 2,
                open: function() {
                    $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                },
                close: function() {
                    $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                }
            });
        });
        /*
        var tx_solr_suggestUrl = \'mknoll.thesis/standard/autocomplete\';
        jQuery(document).ready(function(){

            jQuery(\'#searchPhraseAutoComplete\').autocomplete({
                //appendTo: \'#solrAutoComplete\',
                delay: 500,
                minLength: 2,
                position: {
                    collision: "none",
                    offset: \'0 0\'
                },
                source: function(request, response) {
                    jQuery.ajax({
                        url: tx_solr_suggestUrl,
                        dataType: \'json\',
                        data: {
                            termLowercase: request.term.toLowerCase(),
                            termOriginal: request.term
                        },
                        success: function(data) {
                            var rs     = [],
                                output = [];

                            jQuery.each(data, function(term, termIndex) {
                                output.push({
                                    label : term,
                                    value : request.term,
                                    count: data[term]
                                });
                            });

                            response(output);
                        }
                    })
                },
                select: function(event, ui) {
                    $( "#solrAutoComplete" ).val( ui.item.label );
                    jQuery(event.target).closest(\'form\').submit();
                    return false;
                },
                focus: function( event, ui ) {
                    $( "#solrAutoComplete" ).val( ui.item.label );
                    return false;
                }
            }
            )
            .data( "autocomplete" )._renderItem = function( ul, item ) {

                var formattedLabel = item.label.replace(new RegExp(\'(?![^&;]+;)(?!<[^<>]*)(\' +
                                                            jQuery.ui.autocomplete.escapeRegex(item.value) +
                                                            \')(?![^<>]*>)(?![^&;]+;)\', \'gi\'), \'<strong>$1</strong>\')

                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(
                        "<a>" + formattedLabel + \' <span class="result_count">\' + item.count + \'</span>\' + "</a>"
                        )
                    .appendTo( ul );
            };
        });
        */
    </script>

';

return $output0;
}
/**
 * Main Render function
 */
public function render(\TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output8 = '';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\LayoutViewHelper
$arguments9 = array();
$arguments9['name'] = 'Default';
$renderChildrenClosure10 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper11 = $self->getViewHelper('$viewHelper11', $renderingContext, 'TYPO3\Fluid\ViewHelpers\LayoutViewHelper');
$viewHelper11->setArguments($arguments9);
$viewHelper11->setRenderingContext($renderingContext);
$viewHelper11->setRenderChildrenClosure($renderChildrenClosure10);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\LayoutViewHelper

$output8 .= $viewHelper11->initializeArgumentsAndRender();

$output8 .= '

';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\SectionViewHelper
$arguments12 = array();
$arguments12['name'] = 'Title';
$renderChildrenClosure13 = function() use ($renderingContext, $self) {
return 'Hierarchical Recommender';
};

$output8 .= '';

$output8 .= '

';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\SectionViewHelper
$arguments14 = array();
$arguments14['name'] = 'Content';
$renderChildrenClosure15 = function() use ($renderingContext, $self) {
$output16 = '';

$output16 .= '

    <header class="jumbotron masthead">
        <div class="inner">
            <h1>Hierarchical Recommender</h1>

            <p>Hierarchische Dokumentensuche</p>

            ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\FormViewHelper
$arguments17 = array();
$arguments17['action'] = 'search';
$arguments17['method'] = 'post';
$arguments17['style'] = 'text-align: center';
$arguments17['class'] = 'well form-search';
$arguments17['additionalAttributes'] = NULL;
$arguments17['arguments'] = array (
);
$arguments17['controller'] = NULL;
$arguments17['package'] = NULL;
$arguments17['subpackage'] = NULL;
$arguments17['object'] = NULL;
$arguments17['section'] = '';
$arguments17['format'] = '';
$arguments17['additionalParams'] = array (
);
$arguments17['absolute'] = false;
$arguments17['addQueryString'] = false;
$arguments17['argumentsToBeExcludedFromQueryString'] = array (
);
$arguments17['fieldNamePrefix'] = NULL;
$arguments17['actionUri'] = NULL;
$arguments17['objectName'] = NULL;
$arguments17['enctype'] = NULL;
$arguments17['name'] = NULL;
$arguments17['onreset'] = NULL;
$arguments17['onsubmit'] = NULL;
$arguments17['dir'] = NULL;
$arguments17['id'] = NULL;
$arguments17['lang'] = NULL;
$arguments17['title'] = NULL;
$arguments17['accesskey'] = NULL;
$arguments17['tabindex'] = NULL;
$arguments17['onclick'] = NULL;
$renderChildrenClosure18 = function() use ($renderingContext, $self) {
$output19 = '';

$output19 .= '
                ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper
$arguments20 = array();
$arguments20['id'] = 'searchPhraseAutoComplete';
$arguments20['class'] = 'input-xxlarge btn-large search-query';
$arguments20['name'] = 'phrase';
$arguments20['additionalAttributes'] = NULL;
$arguments20['required'] = NULL;
$arguments20['type'] = 'text';
$arguments20['placeholder'] = NULL;
$arguments20['value'] = NULL;
$arguments20['property'] = NULL;
$arguments20['disabled'] = NULL;
$arguments20['maxlength'] = NULL;
$arguments20['readonly'] = NULL;
$arguments20['size'] = NULL;
$arguments20['errorClass'] = 'f3-form-error';
$arguments20['dir'] = NULL;
$arguments20['lang'] = NULL;
$arguments20['style'] = NULL;
$arguments20['title'] = NULL;
$arguments20['accesskey'] = NULL;
$arguments20['tabindex'] = NULL;
$arguments20['onclick'] = NULL;
$renderChildrenClosure21 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper22 = $self->getViewHelper('$viewHelper22', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper');
$viewHelper22->setArguments($arguments20);
$viewHelper22->setRenderingContext($renderingContext);
$viewHelper22->setRenderChildrenClosure($renderChildrenClosure21);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper

$output19 .= $viewHelper22->initializeArgumentsAndRender();

$output19 .= '
                <button type="submit" class="btn btn-primary btn-large">Suchen</button>
            ';
return $output19;
};
$viewHelper23 = $self->getViewHelper('$viewHelper23', $renderingContext, 'TYPO3\Fluid\ViewHelpers\FormViewHelper');
$viewHelper23->setArguments($arguments17);
$viewHelper23->setRenderingContext($renderingContext);
$viewHelper23->setRenderChildrenClosure($renderChildrenClosure18);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\FormViewHelper

$output16 .= $viewHelper23->initializeArgumentsAndRender();

$output16 .= '

        </div>
    </header>


    <script type="text/javascript">
        $(function() {

            $( "#searchPhraseAutoComplete" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "http://thesis.centos.localhost/mknoll.thesis/standard/autocomplete",
                        dataType: "json",
                        data: {
                            phrase: request.term
                        },
                        success: function( data ) {
                            response( $.map( data.results, function( item ) {
                                return {
                                    label: item.title + (item.docId),
                                    value: item.docId
                                }
                            }));
                        }
                    });
                },
                minLength: 2,
                open: function() {
                    $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                },
                close: function() {
                    $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                }
            });
        });
        /*
        var tx_solr_suggestUrl = \'mknoll.thesis/standard/autocomplete\';
        jQuery(document).ready(function(){

            jQuery(\'#searchPhraseAutoComplete\').autocomplete({
                //appendTo: \'#solrAutoComplete\',
                delay: 500,
                minLength: 2,
                position: {
                    collision: "none",
                    offset: \'0 0\'
                },
                source: function(request, response) {
                    jQuery.ajax({
                        url: tx_solr_suggestUrl,
                        dataType: \'json\',
                        data: {
                            termLowercase: request.term.toLowerCase(),
                            termOriginal: request.term
                        },
                        success: function(data) {
                            var rs     = [],
                                output = [];

                            jQuery.each(data, function(term, termIndex) {
                                output.push({
                                    label : term,
                                    value : request.term,
                                    count: data[term]
                                });
                            });

                            response(output);
                        }
                    })
                },
                select: function(event, ui) {
                    $( "#solrAutoComplete" ).val( ui.item.label );
                    jQuery(event.target).closest(\'form\').submit();
                    return false;
                },
                focus: function( event, ui ) {
                    $( "#solrAutoComplete" ).val( ui.item.label );
                    return false;
                }
            }
            )
            .data( "autocomplete" )._renderItem = function( ul, item ) {

                var formattedLabel = item.label.replace(new RegExp(\'(?![^&;]+;)(?!<[^<>]*)(\' +
                                                            jQuery.ui.autocomplete.escapeRegex(item.value) +
                                                            \')(?![^<>]*>)(?![^&;]+;)\', \'gi\'), \'<strong>$1</strong>\')

                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(
                        "<a>" + formattedLabel + \' <span class="result_count">\' + item.count + \'</span>\' + "</a>"
                        )
                    .appendTo( ul );
            };
        });
        */
    </script>

';
return $output16;
};

$output8 .= '';

return $output8;
}


}
#0             16619     