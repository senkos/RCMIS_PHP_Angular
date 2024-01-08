<?php

/* database/designer/schema_export.twig */
class __TwigTemplate_07acb368b88c346e709dda1f925bf87e298545850822a1798a5752005ca66019 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<form method=\"post\" action=\"schema_export.php\" class=\"disableAjax\" id=\"id_export_pages\">
    <fieldset>
        ";
        // line 3
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
        <label>";
        // line 4
        echo _gettext("Select Export Relational Type");
        echo "</label>
        ";
        // line 5
        echo PhpMyAdmin\Plugins::getChoice("Schema", "export_type", ($context["export_list"] ?? null), "format");
        echo "
        <input type=\"hidden\" name=\"page_number\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["page"] ?? null), "html", null, true);
        echo "\" />
        ";
        // line 7
        echo PhpMyAdmin\Plugins::getOptions("Schema", ($context["export_list"] ?? null));
        echo "
    </fieldset>
</form>
";
    }

    public function getTemplateName()
    {
        return "database/designer/schema_export.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  35 => 6,  31 => 5,  27 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/designer/schema_export.twig", "C:\\Server\\data\\htdocs\\phpmyadmin\\templates\\database\\designer\\schema_export.twig");
    }
}
