<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/task1_module/templates/userlistpage.html.twig */
class __TwigTemplate_e448dba0034d648ceaa504eaa6a69035e0fb15135dcc24f6d048a075190a0ef0 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"view-content\">
   <table class=\"views-table cols-4\">
      <thead>
         <tr>
            <th class=\"views-field views-field-id\" scope=\"col\"></th>
            <th id=\"view-name-table-column\" class=\"views-field views-field-name\" scope=\"col\">Name</th>
            <th id=\"view-email-table-column\" class=\"views-field views-field-email\" scope=\"col\">Email</th>
            <th id=\"view-mobile-table-column\" class=\"views-field views-field-mobile\" scope=\"col\">Mobile</th>
         </tr>
      </thead>

      <div class=\"row\">
        <div class=\"view-header\" style=\"float:left\">
            <a href=\"/project_shadow/display_csv\" class=\"button--primary button  views-display-link views-display-link-data_export_1 btn--primary\">Export CSV</a>
        </div>
        <div class=\"view-header\">
            <a href=\"/project_shadow/register\" class=\"button--primary button  views-display-link views-display-link-data_export_1 btn--primary\">Register</a>
        </div>
     </div>
      <tbody>
        ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["rec"]) {
            // line 22
            echo "         <tr>
            <td class=\"views-field views-field-id\">";
            // line 23
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["rec"], "id", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
            echo "</td>
            <td headers=\"view-name-table-column\" class=\"views-field views-field-name\">";
            // line 24
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["rec"], "name", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
            echo " </td>
            <td headers=\"view-email-table-column\" class=\"views-field views-field-email\">";
            // line 25
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["rec"], "email", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
            echo "          </td>
            <td headers=\"view-mobile-table-column\" class=\"views-field views-field-mobile\">";
            // line 26
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["rec"], "mobile", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
            echo "        </td>
         </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rec'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "      </tbody>
   </table>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/custom/task1_module/templates/userlistpage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 29,  80 => 26,  76 => 25,  72 => 24,  68 => 23,  65 => 22,  61 => 21,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/task1_module/templates/userlistpage.html.twig", "C:\\xampp\\htdocs\\project_shadow\\modules\\custom\\task1_module\\templates\\userlistpage.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 21);
        static $filters = array("escape" => 23);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
