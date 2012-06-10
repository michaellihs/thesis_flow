<?php
class FluidCache_MKnoll_Thesis_Standard_action_index_81b4a8680b6686a6eec8612ff3e6caba0a77a98b extends \TYPO3\Fluid\Core\Compiler\AbstractCompiledTemplate {

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
                ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Form\HiddenViewHelper
$arguments7 = array();
$arguments7['id'] = 'docId';
$arguments7['name'] = 'docId';
$arguments7['additionalAttributes'] = NULL;
$arguments7['value'] = NULL;
$arguments7['property'] = NULL;
$arguments7['class'] = NULL;
$arguments7['dir'] = NULL;
$arguments7['lang'] = NULL;
$arguments7['style'] = NULL;
$arguments7['title'] = NULL;
$arguments7['accesskey'] = NULL;
$arguments7['tabindex'] = NULL;
$arguments7['onclick'] = NULL;
$renderChildrenClosure8 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper9 = $self->getViewHelper('$viewHelper9', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Form\HiddenViewHelper');
$viewHelper9->setArguments($arguments7);
$viewHelper9->setRenderingContext($renderingContext);
$viewHelper9->setRenderChildrenClosure($renderChildrenClosure8);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Form\HiddenViewHelper

$output3 .= $viewHelper9->initializeArgumentsAndRender();

$output3 .= '
                <button type="submit" class="btn btn-primary btn-large">Suchen</button>
            ';
return $output3;
};
$viewHelper10 = $self->getViewHelper('$viewHelper10', $renderingContext, 'TYPO3\Fluid\ViewHelpers\FormViewHelper');
$viewHelper10->setArguments($arguments1);
$viewHelper10->setRenderingContext($renderingContext);
$viewHelper10->setRenderChildrenClosure($renderChildrenClosure2);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\FormViewHelper

$output0 .= $viewHelper10->initializeArgumentsAndRender();

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
                                $( "#docId" ).val( item.docId );
                                return {
                                    label: item.title + "(" + item.docId + ")",
                                    value: item.title
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
$output11 = '';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\LayoutViewHelper
$arguments12 = array();
$arguments12['name'] = 'Default';
$renderChildrenClosure13 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper14 = $self->getViewHelper('$viewHelper14', $renderingContext, 'TYPO3\Fluid\ViewHelpers\LayoutViewHelper');
$viewHelper14->setArguments($arguments12);
$viewHelper14->setRenderingContext($renderingContext);
$viewHelper14->setRenderChildrenClosure($renderChildrenClosure13);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\LayoutViewHelper

$output11 .= $viewHelper14->initializeArgumentsAndRender();

$output11 .= '

';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\SectionViewHelper
$arguments15 = array();
$arguments15['name'] = 'Title';
$renderChildrenClosure16 = function() use ($renderingContext, $self) {
return 'Hierarchical Recommender';
};

$output11 .= '';

$output11 .= '

';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\SectionViewHelper
$arguments17 = array();
$arguments17['name'] = 'Content';
$renderChildrenClosure18 = function() use ($renderingContext, $self) {
$output19 = '';

$output19 .= '

    <header class="jumbotron masthead">
        <div class="inner">
            <h1>Hierarchical Recommender</h1>

            <p>Hierarchische Dokumentensuche</p>

            ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\FormViewHelper
$arguments20 = array();
$arguments20['action'] = 'search';
$arguments20['method'] = 'post';
$arguments20['style'] = 'text-align: center';
$arguments20['class'] = 'well form-search';
$arguments20['additionalAttributes'] = NULL;
$arguments20['arguments'] = array (
);
$arguments20['controller'] = NULL;
$arguments20['package'] = NULL;
$arguments20['subpackage'] = NULL;
$arguments20['object'] = NULL;
$arguments20['section'] = '';
$arguments20['format'] = '';
$arguments20['additionalParams'] = array (
);
$arguments20['absolute'] = false;
$arguments20['addQueryString'] = false;
$arguments20['argumentsToBeExcludedFromQueryString'] = array (
);
$arguments20['fieldNamePrefix'] = NULL;
$arguments20['actionUri'] = NULL;
$arguments20['objectName'] = NULL;
$arguments20['enctype'] = NULL;
$arguments20['name'] = NULL;
$arguments20['onreset'] = NULL;
$arguments20['onsubmit'] = NULL;
$arguments20['dir'] = NULL;
$arguments20['id'] = NULL;
$arguments20['lang'] = NULL;
$arguments20['title'] = NULL;
$arguments20['accesskey'] = NULL;
$arguments20['tabindex'] = NULL;
$arguments20['onclick'] = NULL;
$renderChildrenClosure21 = function() use ($renderingContext, $self) {
$output22 = '';

$output22 .= '
                ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper
$arguments23 = array();
$arguments23['id'] = 'searchPhraseAutoComplete';
$arguments23['class'] = 'input-xxlarge btn-large search-query';
$arguments23['name'] = 'phrase';
$arguments23['additionalAttributes'] = NULL;
$arguments23['required'] = NULL;
$arguments23['type'] = 'text';
$arguments23['placeholder'] = NULL;
$arguments23['value'] = NULL;
$arguments23['property'] = NULL;
$arguments23['disabled'] = NULL;
$arguments23['maxlength'] = NULL;
$arguments23['readonly'] = NULL;
$arguments23['size'] = NULL;
$arguments23['errorClass'] = 'f3-form-error';
$arguments23['dir'] = NULL;
$arguments23['lang'] = NULL;
$arguments23['style'] = NULL;
$arguments23['title'] = NULL;
$arguments23['accesskey'] = NULL;
$arguments23['tabindex'] = NULL;
$arguments23['onclick'] = NULL;
$renderChildrenClosure24 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper25 = $self->getViewHelper('$viewHelper25', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper');
$viewHelper25->setArguments($arguments23);
$viewHelper25->setRenderingContext($renderingContext);
$viewHelper25->setRenderChildrenClosure($renderChildrenClosure24);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Form\TextfieldViewHelper

$output22 .= $viewHelper25->initializeArgumentsAndRender();

$output22 .= '
                ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Form\HiddenViewHelper
$arguments26 = array();
$arguments26['id'] = 'docId';
$arguments26['name'] = 'docId';
$arguments26['additionalAttributes'] = NULL;
$arguments26['value'] = NULL;
$arguments26['property'] = NULL;
$arguments26['class'] = NULL;
$arguments26['dir'] = NULL;
$arguments26['lang'] = NULL;
$arguments26['style'] = NULL;
$arguments26['title'] = NULL;
$arguments26['accesskey'] = NULL;
$arguments26['tabindex'] = NULL;
$arguments26['onclick'] = NULL;
$renderChildrenClosure27 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper28 = $self->getViewHelper('$viewHelper28', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Form\HiddenViewHelper');
$viewHelper28->setArguments($arguments26);
$viewHelper28->setRenderingContext($renderingContext);
$viewHelper28->setRenderChildrenClosure($renderChildrenClosure27);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Form\HiddenViewHelper

$output22 .= $viewHelper28->initializeArgumentsAndRender();

$output22 .= '
                <button type="submit" class="btn btn-primary btn-large">Suchen</button>
            ';
return $output22;
};
$viewHelper29 = $self->getViewHelper('$viewHelper29', $renderingContext, 'TYPO3\Fluid\ViewHelpers\FormViewHelper');
$viewHelper29->setArguments($arguments20);
$viewHelper29->setRenderingContext($renderingContext);
$viewHelper29->setRenderChildrenClosure($renderChildrenClosure21);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\FormViewHelper

$output19 .= $viewHelper29->initializeArgumentsAndRender();

$output19 .= '

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
                                $( "#docId" ).val( item.docId );
                                return {
                                    label: item.title + "(" + item.docId + ")",
                                    value: item.title
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
return $output19;
};

$output11 .= '';

return $output11;
}


}
#0             18856     