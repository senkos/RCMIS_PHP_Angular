<?php

/* database/structure/browse_table.twig */
class __TwigTemplate_e26a892df22db56922a75b6b833826ee87005c20244e79c49be7c7508afcaaea extends Twig_Template
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
        echo "<a href=\"sql.php";
        echo ($context["tbl_url_query"] ?? null);
        echo "&amp;pos=0\">
    ";
        // line 2
        echo ($context["title"] ?? null);
        echo "
</a>
";
    }

    public function getTemplateName()
    {
        return "database/structure/browse_table.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/structure/browse_table.twig", "C:\\Server\\data\\htdocs\\phpmyadmin\\templates\\database\\structure\\browse_table.twig");
    }
}
