<?php
class FluidCache_TYPO3_Welcome_Standard_action_index_18ad5b2abbecdf30ba1538268308d41e79bae7f3 extends \TYPO3\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getVariableContainer() {
	// TODO
	return new \TYPO3\Fluid\Core\ViewHelper\TemplateVariableContainer();
}
public function getLayoutName(\TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {

return NULL;
}
public function hasLayout() {
return FALSE;
}

/**
 * Main Render function
 */
public function render(\TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:f="urn:flow3:fluid">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome to FLOW3</title>
';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\BaseViewHelper
$arguments1 = array();
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper3 = $self->getViewHelper('$viewHelper3', $renderingContext, 'TYPO3\Fluid\ViewHelpers\BaseViewHelper');
$viewHelper3->setArguments($arguments1);
$viewHelper3->setRenderingContext($renderingContext);
$viewHelper3->setRenderChildrenClosure($renderChildrenClosure2);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\BaseViewHelper

$output0 .= $viewHelper3->initializeArgumentsAndRender();
$output4 = '';

$output4 .= '
<link rel="stylesheet" type="text/css" href="';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Uri\ResourceViewHelper
$arguments5 = array();
$arguments5['path'] = 'Css/Styles.css';
$arguments5['package'] = NULL;
$arguments5['resource'] = NULL;
$arguments5['uri'] = NULL;
$renderChildrenClosure6 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper7 = $self->getViewHelper('$viewHelper7', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Uri\ResourceViewHelper');
$viewHelper7->setArguments($arguments5);
$viewHelper7->setRenderingContext($renderingContext);
$viewHelper7->setRenderChildrenClosure($renderChildrenClosure6);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Uri\ResourceViewHelper

$output4 .= $viewHelper7->initializeArgumentsAndRender();

$output4 .= '" />
<script type="text/javascript" src="';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Uri\ResourceViewHelper
$arguments8 = array();
$arguments8['path'] = 'JavaScript/mootools-1.2.2-core-yc.js';
$arguments8['package'] = NULL;
$arguments8['resource'] = NULL;
$arguments8['uri'] = NULL;
$renderChildrenClosure9 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper10 = $self->getViewHelper('$viewHelper10', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Uri\ResourceViewHelper');
$viewHelper10->setArguments($arguments8);
$viewHelper10->setRenderingContext($renderingContext);
$viewHelper10->setRenderChildrenClosure($renderChildrenClosure9);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Uri\ResourceViewHelper

$output4 .= $viewHelper10->initializeArgumentsAndRender();

$output4 .= '"></script>
<script type="text/javascript">
window.addEvent(\'domready\', function() {
	$$(\'.tab\').each(function(element, index) {
		element.addClass(index == 0 ? \'tab-active\' : \'tab-inactive\');
		element.getFirst(\'h2\').addEvent(\'click\', function() {
			$$(\'.tab\').removeClass(\'tab-active\').addClass(\'tab-inactive\');
			element.addClass(\'tab-active\').removeClass(\'tab-inactive\');
		});
	});
});
</script>
</head>
<body>

<div id="application-bar">
<div class="logo">FLOW3</div> <h1 class="title">Welcome</h1>
<div class="version">';

$output0 .= $output4;
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments11 = array();
$arguments11['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'version', $renderingContext);
$arguments11['keepQuotes'] = false;
$arguments11['encoding'] = 'UTF-8';
$arguments11['doubleEncode'] = true;
$renderChildrenClosure12 = function() use ($renderingContext, $self) {
return NULL;
};
$value13 = ($arguments11['value'] !== NULL ? $arguments11['value'] : $renderChildrenClosure12());

$output0 .= (!is_string($value13) ? $value13 : htmlspecialchars($value13, ($arguments11['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments11['encoding'], $arguments11['doubleEncode']));

$output0 .= '</div>
</div>

<div id="messages">
';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper
$arguments14 = array();
// Rendering Boolean node
$arguments14['condition'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(\TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'notDevelopmentContext', $renderingContext));
$arguments14['then'] = NULL;
$arguments14['else'] = NULL;
$renderChildrenClosure15 = function() use ($renderingContext, $self) {
return '
	<div class="notice">
		<h2>Switch to Development context</h2>
		<p>You should enable the Development context for your first steps into the world of FLOW3!<br />
		Check the <a href="http://flow3.typo3.org/documentation/guide.html" target="flow3">FLOW3 reference</a> and/or
		the <a href="http://flow3.typo3.org/documentation/quickstart.html" target="flow3">Quickstart tutorial</a> for instructions.</p>
	</div>
';
};
$viewHelper16 = $self->getViewHelper('$viewHelper16', $renderingContext, 'TYPO3\Fluid\ViewHelpers\IfViewHelper');
$viewHelper16->setArguments($arguments14);
$viewHelper16->setRenderingContext($renderingContext);
$viewHelper16->setRenderChildrenClosure($renderChildrenClosure15);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper

$output0 .= $viewHelper16->initializeArgumentsAndRender();

$output0 .= '
</div>

<div id="window">
	<div class="tabs">
		<div class="tab">
			<h2 class="title title-getting-started">Getting started</h2>
			<div class="content">
				<div class="main">
					<div class="spacer">
						<p>Here\'s how to get into the flow:</p>
						<ol class="steps">
							<li>
								<h3>Kickstart your first package</h3>
								';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper
$arguments17 = array();
// Rendering Boolean node
$arguments17['condition'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(\TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'isWindows', $renderingContext));
$arguments17['then'] = NULL;
$arguments17['else'] = NULL;
$renderChildrenClosure18 = function() use ($renderingContext, $self) {
$output19 = '';

$output19 .= '
									';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\ThenViewHelper
$arguments20 = array();
$renderChildrenClosure21 = function() use ($renderingContext, $self) {
$output22 = '';

$output22 .= '
										<p>Go to <code>';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments23 = array();
$arguments23['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathRoot', $renderingContext);
$arguments23['keepQuotes'] = false;
$arguments23['encoding'] = 'UTF-8';
$arguments23['doubleEncode'] = true;
$renderChildrenClosure24 = function() use ($renderingContext, $self) {
return NULL;
};
$value25 = ($arguments23['value'] !== NULL ? $arguments23['value'] : $renderChildrenClosure24());

$output22 .= (!is_string($value25) ? $value25 : htmlspecialchars($value25, ($arguments23['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments23['encoding'], $arguments23['doubleEncode']));

$output22 .= '</code><br />and run the following lines of code:<br />
											<code>set FLOW3_CONTEXT=Development</code><br />
											<code>set FLOW3_ROOTPATH=';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments26 = array();
$arguments26['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathRoot', $renderingContext);
$arguments26['keepQuotes'] = false;
$arguments26['encoding'] = 'UTF-8';
$arguments26['doubleEncode'] = true;
$renderChildrenClosure27 = function() use ($renderingContext, $self) {
return NULL;
};
$value28 = ($arguments26['value'] !== NULL ? $arguments26['value'] : $renderChildrenClosure27());

$output22 .= (!is_string($value28) ? $value28 : htmlspecialchars($value28, ($arguments26['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments26['encoding'], $arguments26['doubleEncode']));

$output22 .= '</code><br />
											<code>set FLOW3_WEBPATH=';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments29 = array();
$arguments29['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathWeb', $renderingContext);
$arguments29['keepQuotes'] = false;
$arguments29['encoding'] = 'UTF-8';
$arguments29['doubleEncode'] = true;
$renderChildrenClosure30 = function() use ($renderingContext, $self) {
return NULL;
};
$value31 = ($arguments29['value'] !== NULL ? $arguments29['value'] : $renderChildrenClosure30());

$output22 .= (!is_string($value31) ? $value31 : htmlspecialchars($value31, ($arguments29['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments29['encoding'], $arguments29['doubleEncode']));

$output22 .= '</code><br />
											<code>flow3.bat kickstart:package MyCompany.MyPackage</code><br />
											to create a package with a standard controller</p>
									';
return $output22;
};
$viewHelper32 = $self->getViewHelper('$viewHelper32', $renderingContext, 'TYPO3\Fluid\ViewHelpers\ThenViewHelper');
$viewHelper32->setArguments($arguments20);
$viewHelper32->setRenderingContext($renderingContext);
$viewHelper32->setRenderChildrenClosure($renderChildrenClosure21);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\ThenViewHelper

$output19 .= $viewHelper32->initializeArgumentsAndRender();

$output19 .= '
									';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\ElseViewHelper
$arguments33 = array();
$renderChildrenClosure34 = function() use ($renderingContext, $self) {
$output35 = '';

$output35 .= '
										<p>Go to <code>';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments36 = array();
$arguments36['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathRoot', $renderingContext);
$arguments36['keepQuotes'] = false;
$arguments36['encoding'] = 'UTF-8';
$arguments36['doubleEncode'] = true;
$renderChildrenClosure37 = function() use ($renderingContext, $self) {
return NULL;
};
$value38 = ($arguments36['value'] !== NULL ? $arguments36['value'] : $renderChildrenClosure37());

$output35 .= (!is_string($value38) ? $value38 : htmlspecialchars($value38, ($arguments36['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments36['encoding'], $arguments36['doubleEncode']));

$output35 .= '</code><br />and run<br /><code>./flow3 kickstart:package MyCompany.MyPackage</code><br />
											to create a package with a standard controller</p>
									';
return $output35;
};
$viewHelper39 = $self->getViewHelper('$viewHelper39', $renderingContext, 'TYPO3\Fluid\ViewHelpers\ElseViewHelper');
$viewHelper39->setArguments($arguments33);
$viewHelper39->setRenderingContext($renderingContext);
$viewHelper39->setRenderChildrenClosure($renderChildrenClosure34);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\ElseViewHelper

$output19 .= $viewHelper39->initializeArgumentsAndRender();

$output19 .= '
								';
return $output19;
};
$arguments17['__thenClosure'] = function() use ($renderingContext, $self) {
$output40 = '';

$output40 .= '
										<p>Go to <code>';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments41 = array();
$arguments41['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathRoot', $renderingContext);
$arguments41['keepQuotes'] = false;
$arguments41['encoding'] = 'UTF-8';
$arguments41['doubleEncode'] = true;
$renderChildrenClosure42 = function() use ($renderingContext, $self) {
return NULL;
};
$value43 = ($arguments41['value'] !== NULL ? $arguments41['value'] : $renderChildrenClosure42());

$output40 .= (!is_string($value43) ? $value43 : htmlspecialchars($value43, ($arguments41['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments41['encoding'], $arguments41['doubleEncode']));

$output40 .= '</code><br />and run the following lines of code:<br />
											<code>set FLOW3_CONTEXT=Development</code><br />
											<code>set FLOW3_ROOTPATH=';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments44 = array();
$arguments44['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathRoot', $renderingContext);
$arguments44['keepQuotes'] = false;
$arguments44['encoding'] = 'UTF-8';
$arguments44['doubleEncode'] = true;
$renderChildrenClosure45 = function() use ($renderingContext, $self) {
return NULL;
};
$value46 = ($arguments44['value'] !== NULL ? $arguments44['value'] : $renderChildrenClosure45());

$output40 .= (!is_string($value46) ? $value46 : htmlspecialchars($value46, ($arguments44['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments44['encoding'], $arguments44['doubleEncode']));

$output40 .= '</code><br />
											<code>set FLOW3_WEBPATH=';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments47 = array();
$arguments47['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathWeb', $renderingContext);
$arguments47['keepQuotes'] = false;
$arguments47['encoding'] = 'UTF-8';
$arguments47['doubleEncode'] = true;
$renderChildrenClosure48 = function() use ($renderingContext, $self) {
return NULL;
};
$value49 = ($arguments47['value'] !== NULL ? $arguments47['value'] : $renderChildrenClosure48());

$output40 .= (!is_string($value49) ? $value49 : htmlspecialchars($value49, ($arguments47['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments47['encoding'], $arguments47['doubleEncode']));

$output40 .= '</code><br />
											<code>flow3.bat kickstart:package MyCompany.MyPackage</code><br />
											to create a package with a standard controller</p>
									';
return $output40;
};
$arguments17['__elseClosure'] = function() use ($renderingContext, $self) {
$output50 = '';

$output50 .= '
										<p>Go to <code>';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments51 = array();
$arguments51['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'flow3PathRoot', $renderingContext);
$arguments51['keepQuotes'] = false;
$arguments51['encoding'] = 'UTF-8';
$arguments51['doubleEncode'] = true;
$renderChildrenClosure52 = function() use ($renderingContext, $self) {
return NULL;
};
$value53 = ($arguments51['value'] !== NULL ? $arguments51['value'] : $renderChildrenClosure52());

$output50 .= (!is_string($value53) ? $value53 : htmlspecialchars($value53, ($arguments51['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments51['encoding'], $arguments51['doubleEncode']));

$output50 .= '</code><br />and run<br /><code>./flow3 kickstart:package MyCompany.MyPackage</code><br />
											to create a package with a standard controller</p>
									';
return $output50;
};
$viewHelper54 = $self->getViewHelper('$viewHelper54', $renderingContext, 'TYPO3\Fluid\ViewHelpers\IfViewHelper');
$viewHelper54->setArguments($arguments17);
$viewHelper54->setRenderingContext($renderingContext);
$viewHelper54->setRenderChildrenClosure($renderChildrenClosure18);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper

$output0 .= $viewHelper54->initializeArgumentsAndRender();

$output0 .= '
							</li>
							<li>
								<h3>Test your controller</h3>
								';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper
$arguments55 = array();
// Rendering Boolean node
$arguments55['condition'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(\TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'isMyPackageActive', $renderingContext));
$arguments55['then'] = NULL;
$arguments55['else'] = NULL;
$renderChildrenClosure56 = function() use ($renderingContext, $self) {
$output57 = '';

$output57 .= '
									';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\ThenViewHelper
$arguments58 = array();
$renderChildrenClosure59 = function() use ($renderingContext, $self) {
$output60 = '';

$output60 .= '
										<p>Click on ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Link\ActionViewHelper
$arguments61 = array();
$arguments61['package'] = 'MyCompany.MyPackage';
$arguments61['additionalAttributes'] = NULL;
$arguments61['action'] = NULL;
$arguments61['arguments'] = array (
);
$arguments61['controller'] = NULL;
$arguments61['subpackage'] = NULL;
$arguments61['section'] = '';
$arguments61['format'] = '';
$arguments61['additionalParams'] = array (
);
$arguments61['addQueryString'] = false;
$arguments61['argumentsToBeExcludedFromQueryString'] = array (
);
$arguments61['class'] = NULL;
$arguments61['dir'] = NULL;
$arguments61['id'] = NULL;
$arguments61['lang'] = NULL;
$arguments61['style'] = NULL;
$arguments61['title'] = NULL;
$arguments61['accesskey'] = NULL;
$arguments61['tabindex'] = NULL;
$arguments61['onclick'] = NULL;
$arguments61['name'] = NULL;
$arguments61['rel'] = NULL;
$arguments61['rev'] = NULL;
$arguments61['target'] = NULL;
$renderChildrenClosure62 = function() use ($renderingContext, $self) {
return 'this link';
};
$viewHelper63 = $self->getViewHelper('$viewHelper63', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Link\ActionViewHelper');
$viewHelper63->setArguments($arguments61);
$viewHelper63->setRenderingContext($renderingContext);
$viewHelper63->setRenderChildrenClosure($renderChildrenClosure62);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Link\ActionViewHelper

$output60 .= $viewHelper63->initializeArgumentsAndRender();

$output60 .= ' to trigger your new package</p>
									';
return $output60;
};
$viewHelper64 = $self->getViewHelper('$viewHelper64', $renderingContext, 'TYPO3\Fluid\ViewHelpers\ThenViewHelper');
$viewHelper64->setArguments($arguments58);
$viewHelper64->setRenderingContext($renderingContext);
$viewHelper64->setRenderChildrenClosure($renderChildrenClosure59);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\ThenViewHelper

$output57 .= $viewHelper64->initializeArgumentsAndRender();

$output57 .= '
									';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\ElseViewHelper
$arguments65 = array();
$renderChildrenClosure66 = function() use ($renderingContext, $self) {
$output67 = '';

$output67 .= '
										<p><em>"MyCompany.MyPackage" has either not yet been created or not activated. Follow step 1 and <a href="javascript:window.location.reload()">reload</a> this page.</em></p>
										<p><em>If you named your package "SomethingElse" visit ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments68 = array();
$arguments68['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'baseUri', $renderingContext);
$arguments68['keepQuotes'] = false;
$arguments68['encoding'] = 'UTF-8';
$arguments68['doubleEncode'] = true;
$renderChildrenClosure69 = function() use ($renderingContext, $self) {
return NULL;
};
$value70 = ($arguments68['value'] !== NULL ? $arguments68['value'] : $renderChildrenClosure69());

$output67 .= (!is_string($value70) ? $value70 : htmlspecialchars($value70, ($arguments68['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments68['encoding'], $arguments68['doubleEncode']));

$output67 .= 'SomethingElse/</em></p>
									';
return $output67;
};
$viewHelper71 = $self->getViewHelper('$viewHelper71', $renderingContext, 'TYPO3\Fluid\ViewHelpers\ElseViewHelper');
$viewHelper71->setArguments($arguments65);
$viewHelper71->setRenderingContext($renderingContext);
$viewHelper71->setRenderChildrenClosure($renderChildrenClosure66);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\ElseViewHelper

$output57 .= $viewHelper71->initializeArgumentsAndRender();

$output57 .= '
								';
return $output57;
};
$arguments55['__thenClosure'] = function() use ($renderingContext, $self) {
$output72 = '';

$output72 .= '
										<p>Click on ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Link\ActionViewHelper
$arguments73 = array();
$arguments73['package'] = 'MyCompany.MyPackage';
$arguments73['additionalAttributes'] = NULL;
$arguments73['action'] = NULL;
$arguments73['arguments'] = array (
);
$arguments73['controller'] = NULL;
$arguments73['subpackage'] = NULL;
$arguments73['section'] = '';
$arguments73['format'] = '';
$arguments73['additionalParams'] = array (
);
$arguments73['addQueryString'] = false;
$arguments73['argumentsToBeExcludedFromQueryString'] = array (
);
$arguments73['class'] = NULL;
$arguments73['dir'] = NULL;
$arguments73['id'] = NULL;
$arguments73['lang'] = NULL;
$arguments73['style'] = NULL;
$arguments73['title'] = NULL;
$arguments73['accesskey'] = NULL;
$arguments73['tabindex'] = NULL;
$arguments73['onclick'] = NULL;
$arguments73['name'] = NULL;
$arguments73['rel'] = NULL;
$arguments73['rev'] = NULL;
$arguments73['target'] = NULL;
$renderChildrenClosure74 = function() use ($renderingContext, $self) {
return 'this link';
};
$viewHelper75 = $self->getViewHelper('$viewHelper75', $renderingContext, 'TYPO3\Fluid\ViewHelpers\Link\ActionViewHelper');
$viewHelper75->setArguments($arguments73);
$viewHelper75->setRenderingContext($renderingContext);
$viewHelper75->setRenderChildrenClosure($renderChildrenClosure74);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\Link\ActionViewHelper

$output72 .= $viewHelper75->initializeArgumentsAndRender();

$output72 .= ' to trigger your new package</p>
									';
return $output72;
};
$arguments55['__elseClosure'] = function() use ($renderingContext, $self) {
$output76 = '';

$output76 .= '
										<p><em>"MyCompany.MyPackage" has either not yet been created or not activated. Follow step 1 and <a href="javascript:window.location.reload()">reload</a> this page.</em></p>
										<p><em>If you named your package "SomethingElse" visit ';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments77 = array();
$arguments77['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'baseUri', $renderingContext);
$arguments77['keepQuotes'] = false;
$arguments77['encoding'] = 'UTF-8';
$arguments77['doubleEncode'] = true;
$renderChildrenClosure78 = function() use ($renderingContext, $self) {
return NULL;
};
$value79 = ($arguments77['value'] !== NULL ? $arguments77['value'] : $renderChildrenClosure78());

$output76 .= (!is_string($value79) ? $value79 : htmlspecialchars($value79, ($arguments77['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments77['encoding'], $arguments77['doubleEncode']));

$output76 .= 'SomethingElse/</em></p>
									';
return $output76;
};
$viewHelper80 = $self->getViewHelper('$viewHelper80', $renderingContext, 'TYPO3\Fluid\ViewHelpers\IfViewHelper');
$viewHelper80->setArguments($arguments55);
$viewHelper80->setRenderingContext($renderingContext);
$viewHelper80->setRenderChildrenClosure($renderChildrenClosure56);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper

$output0 .= $viewHelper80->initializeArgumentsAndRender();

$output0 .= '
							</li>
							<li>
								<h3>Read the tutorial</h3>
								<p>Switch over to the <a href="http://flow3.typo3.org/documentation/quickstart.html" target="flow3">Quickstart Tutorial</a> to get the a first overview.</p>
							</li>
							<li>
								<h3>Deactivate the Welcome package (optional)</h3>
								<p>Deactivate the Welcome package with<br />
								';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper
$arguments81 = array();
// Rendering Boolean node
$arguments81['condition'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\BooleanNode::convertToBoolean(\TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'isWindows', $renderingContext));
$arguments81['then'] = NULL;
$arguments81['else'] = NULL;
$renderChildrenClosure82 = function() use ($renderingContext, $self) {
$output83 = '';

$output83 .= '
									';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\ThenViewHelper
$arguments84 = array();
$renderChildrenClosure85 = function() use ($renderingContext, $self) {
return '
										<code>flow3.bat package:deactivate TYPO3.Welcome</code>
									';
};
$viewHelper86 = $self->getViewHelper('$viewHelper86', $renderingContext, 'TYPO3\Fluid\ViewHelpers\ThenViewHelper');
$viewHelper86->setArguments($arguments84);
$viewHelper86->setRenderingContext($renderingContext);
$viewHelper86->setRenderChildrenClosure($renderChildrenClosure85);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\ThenViewHelper

$output83 .= $viewHelper86->initializeArgumentsAndRender();

$output83 .= '
									';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\ElseViewHelper
$arguments87 = array();
$renderChildrenClosure88 = function() use ($renderingContext, $self) {
return '
										<code>./flow3 package:deactivate TYPO3.Welcome</code>
									';
};
$viewHelper89 = $self->getViewHelper('$viewHelper89', $renderingContext, 'TYPO3\Fluid\ViewHelpers\ElseViewHelper');
$viewHelper89->setArguments($arguments87);
$viewHelper89->setRenderingContext($renderingContext);
$viewHelper89->setRenderChildrenClosure($renderChildrenClosure88);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\ElseViewHelper

$output83 .= $viewHelper89->initializeArgumentsAndRender();

$output83 .= '
								';
return $output83;
};
$arguments81['__thenClosure'] = function() use ($renderingContext, $self) {
return '
										<code>flow3.bat package:deactivate TYPO3.Welcome</code>
									';
};
$arguments81['__elseClosure'] = function() use ($renderingContext, $self) {
return '
										<code>./flow3 package:deactivate TYPO3.Welcome</code>
									';
};
$viewHelper90 = $self->getViewHelper('$viewHelper90', $renderingContext, 'TYPO3\Fluid\ViewHelpers\IfViewHelper');
$viewHelper90->setArguments($arguments81);
$viewHelper90->setRenderingContext($renderingContext);
$viewHelper90->setRenderChildrenClosure($renderChildrenClosure82);
// End of ViewHelper TYPO3\Fluid\ViewHelpers\IfViewHelper

$output0 .= $viewHelper90->initializeArgumentsAndRender();

$output0 .= '
								<p>Afterwards make sure to <strong>remove the &quot;Welcome&quot; SubRoute definition</strong> from the global routes in <em>Configuration/Routes.yaml</em>.</p>
							</li>
						</ol>
					</div>
				</div>
				<h2 class="invisible">More information</h2>
				<div class="sidebar">
					<h3>Join the community</h3>
					<ul>
						<li><a href="http://flow3.typo3.org" target="flow3">FLOW3</a></li>
					</ul>
					<h3>Read the documentation</h3>
					<ul>
						<li><a href="http://flow3.typo3.org/documentation/" target="flow3">Documentation</a></li>
						<li><a href="http://flow3.typo3.org/documentation/api/" target="flow3">FLOW3 API</a></li>
						<li><a href="http://flow3.typo3.org/documentation/codingguidelines.html" target="flow3">Coding guidelines</a></li>
						<li><a href="http://forge.typo3.org/projects/flow3-distribution-base/issues?query_id=90" target="flow3">Known issues</a></li>
					</ul>
					<h3>Get involved</h3>
					<ul>
						<li><a href="http://flow3.typo3.org/support.html" target="flow3">Discuss your experience</a></li>
						<li><a href="http://forge.typo3.org/projects/flow3-distribution-base/issues/new" target="flow3">Report a bug</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="tab">
			<h2 class="title title-about">About</h2>
			<div class="content">
				<div class="main">
					<div class="spacer">
						<h3 class="first">About FLOW3</h3>
						<p>FLOW3 is an offspring from the development of the upcoming rewrite of <a href="http://typo3.org">TYPO3</a> and
						can be used independently from TYPO3 as an application framework. It is licensed under the terms of the GNU Lesser General
						Public License version 3 or later.</p>
						<h3>Credits</h3>
						<p>Many people have contributed to FLOW3 with ideas, design, testing, money, code and espresso. A big thank you goes to the
						TYPO3 community and the members of the TYPO3 Assocation who made the development of FLOW3 possible at all.</p>
						<p>The main part of FLOW3 was designed and developed by Robert Lemke. The persistence integration was developed and major
						contributions to FLOW3 were made by Karsten Dambekalns, who co-leads the FLOW3 project. Andreas Förthner designed and developed the
						Security Framework while Bastian Waidelich created the initial implementation of FLOW3\'s routing mechanism. Sebastian Kurf&uuml;rst
						and Bastian Waidelich designed and implemented the Fluid templating engine.</p>
						<p>Further code contributions were made by the FLOW3 team and others: Adrian Föder, Alexander Stehlik, Andreas Wolf, Aske Ertmann,
						Bernhard Fischer, Christian Jul Jensen, Christian Kuhn, Christian Müller, Christopher Hlubek, Daniel Brün, Felix Oertel, Ferdinand Kuhl,
						Irene Höppner, Jochen Rau, Johannes Künsebeck, Julian Kleinhans, Julian Wachholz, Karol Gusak, Lars Peipmann, Lienhart Woitok, Marco Huber,
						Martin Brüggemann, Martin Ficzel, Michael Klapper, Michael Sauter, Nils Jeisecke, Oliver Hader, Rens Admiraal, Sascha Egerer,
						Stefan Neufeind, Stephan Schuler, Thomas Hempel, Thomas Layh, Tim Eilers, Tobias Liebig, Tolleiv Nietsch and Zach Davis.</p>
						<p>The initial design of the AOP framework and the IoC container were inspired by the viFramework developed by Florian Grandel who
						also pointed Robert to the Spring Framework which was a great source for inspiration. Further frameworks and projects which influenced
						the design of FLOW3 are AspectJ, NanoContainer, Ruby on Rails, Symfony, QT and surely more.</p>
						<p>The overall design and concepts would be way less mature and elegant if experts like Martin Fowler, Eric Evans, Jimmy Nilsson,
						Kent Beck or Paul Duvall wouldn\'t have shared their insights in books and talks.</p>
						<p>Many more contributions have been made by various members of the TYPO3 and PHP community - thanks to all of you!</p>
						<h3>Installed Packages</h3>
						<ul class="packages">
						';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\ForViewHelper
$arguments91 = array();
$arguments91['each'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'activePackages', $renderingContext);
$arguments91['as'] = 'package';
$arguments91['key'] = '';
$arguments91['reverse'] = false;
$arguments91['iteration'] = NULL;
$renderChildrenClosure92 = function() use ($renderingContext, $self) {
$output93 = '';

$output93 .= '
							<li class="package">
								<h4>';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments94 = array();
$arguments94['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'package.packageMetaData.title', $renderingContext);
$arguments94['keepQuotes'] = false;
$arguments94['encoding'] = 'UTF-8';
$arguments94['doubleEncode'] = true;
$renderChildrenClosure95 = function() use ($renderingContext, $self) {
return NULL;
};
$value96 = ($arguments94['value'] !== NULL ? $arguments94['value'] : $renderChildrenClosure95());

$output93 .= (!is_string($value96) ? $value96 : htmlspecialchars($value96, ($arguments94['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments94['encoding'], $arguments94['doubleEncode']));

$output93 .= ' <small><span class="package-key">';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments97 = array();
$arguments97['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'package.packageKey', $renderingContext);
$arguments97['keepQuotes'] = false;
$arguments97['encoding'] = 'UTF-8';
$arguments97['doubleEncode'] = true;
$renderChildrenClosure98 = function() use ($renderingContext, $self) {
return NULL;
};
$value99 = ($arguments97['value'] !== NULL ? $arguments97['value'] : $renderChildrenClosure98());

$output93 .= (!is_string($value99) ? $value99 : htmlspecialchars($value99, ($arguments97['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments97['encoding'], $arguments97['doubleEncode']));

$output93 .= '</span> <span class="package-version">';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments100 = array();
$arguments100['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'package.packageMetaData.version', $renderingContext);
$arguments100['keepQuotes'] = false;
$arguments100['encoding'] = 'UTF-8';
$arguments100['doubleEncode'] = true;
$renderChildrenClosure101 = function() use ($renderingContext, $self) {
return NULL;
};
$value102 = ($arguments100['value'] !== NULL ? $arguments100['value'] : $renderChildrenClosure101());

$output93 .= (!is_string($value102) ? $value102 : htmlspecialchars($value102, ($arguments100['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments100['encoding'], $arguments100['doubleEncode']));

$output93 .= '</span></small></h4>
								<p>';
// Rendering ViewHelper TYPO3\Fluid\ViewHelpers\Format\HtmlspecialcharsViewHelper
$arguments103 = array();
$arguments103['value'] = \TYPO3\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), 'package.packageMetaData.description', $renderingContext);
$arguments103['keepQuotes'] = false;
$arguments103['encoding'] = 'UTF-8';
$arguments103['doubleEncode'] = true;
$renderChildrenClosure104 = function() use ($renderingContext, $self) {
return NULL;
};
$value105 = ($arguments103['value'] !== NULL ? $arguments103['value'] : $renderChildrenClosure104());

$output93 .= (!is_string($value105) ? $value105 : htmlspecialchars($value105, ($arguments103['keepQuotes'] ? ENT_NOQUOTES : ENT_COMPAT), $arguments103['encoding'], $arguments103['doubleEncode']));

$output93 .= '</p>
							</li>
						';
return $output93;
};

$output0 .= TYPO3\Fluid\ViewHelpers\ForViewHelper::renderStatic($arguments91, $renderChildrenClosure92, $renderingContext);

$output0 .= '
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
';

return $output0;
}


}
#0             35270     