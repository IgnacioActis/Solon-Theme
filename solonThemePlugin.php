<?php

namespace APP\plugins\themes\solonTheme;

use APP\core\Application;
use PKP\config\Config;
use PKP\plugins\ThemePlugin;

class solonThemePlugin extends ThemePlugin
{
    /**
     * Load the custom styles for our theme
     * @return null
     */
    public function init()
    {
        // Registrar el tema principal
        $this->setParent('defaultthemeplugin');

        // Opciones para el Header
        $this->registerHeaderOptions();

        // Opciones para el Body
        $this->registerBodyOptions();

        // Opciones para el Footer
        $this->registerFooterOptions();

        // Opciones para el Page Article
        $this->registerPageArticleOptions();

        // Cargar los estilos personalizados
        $this->addStyle('stylesheet', 'styles/style.css');

        // Aplicar opciones de estilo
        $this->applyStyleOptions();
    }

    /**
     * Register header options
     * @return null
     */
    private function registerHeaderOptions()
    {
        $this->addOption('headerHeight', 'FieldText', [
            'label' => __('plugins.themes.solonTheme.option.headerHeight.label'),
            'description' => __('plugins.themes.solonTheme.option.headerHeight.description'),
            'default' => '60px',
        ]);

        $this->addOption('stickyHeader', 'FieldOptions', [
            'type' => 'radio',
            'label' => __('plugins.themes.solonTheme.option.stickyHeader.label'),
            'description' => __('Opciones de la Cabecera'),
            'options' => [
                [
                    'value' => 'sticky',
                    'label' => __('Cabecera Fija'),
                ],
                [
                    'value' => 'static',
                    'label' => __('Cabecera Estatica'),
                ],
            ],
            'default' => 'static',
        ]);
    }

    /**
     * Register body options
     * @return null
     */
    private function registerBodyOptions()
    {
        $this->addOption('bodyFont', 'FieldText', [
            'label' => __('plugins.themes.solonTheme.option.bodyFont.label'),
            'description' => __('plugins.themes.solonTheme.option.bodyFont.description'),
            'default' => 'Arial, sans-serif',
        ]);

        $this->addOption('bodyColor', 'FieldColor', [
            'label' => __('plugins.themes.solonTheme.option.bodyColor.label'),
            'description' => __('plugins.themes.solonTheme.option.bodyColor.description'),
            'default' => '#000000',
        ]);
    }

    /**
     * Register footer options
     * @return null
     */
    private function registerFooterOptions()
    {
        $this->addOption('footerHeight', 'FieldText', [
            'label' => __('plugins.themes.solonTheme.option.footerHeight.label'),
            'description' => __('plugins.themes.solonTheme.option.footerHeight.description'),
            'default' => '100px',
        ]);

        $this->addOption('footerColor', 'FieldColor', [
            'label' => __('plugins.themes.solonTheme.option.footerColor.label'),
            'description' => __('plugins.themes.solonTheme.option.footerColor.description'),
            'default' => '#333333',
        ]);
    }

    /**
     * Register page article options
     * @return null
     */
    private function registerPageArticleOptions()
    {
        $this->addOption('articleMargin', 'FieldText', [
            'label' => __('plugins.themes.solonTheme.option.articleMargin.label'),
            'description' => __('plugins.themes.solonTheme.option.articleMargin.description'),
            'default' => '20px',
        ]);

        $this->addOption('articleTitleFont', 'FieldText', [
            'label' => __('plugins.themes.solonTheme.option.articleTitleFont.label'),
            'description' => __('plugins.themes.solonTheme.option.articleTitleFont.description'),
            'default' => 'Georgia, serif',
        ]);
    }

    /**
     * Apply style options
     * @return null
     */
    private function applyStyleOptions()
    {
        $this->modifyStyle('stylesheet', [
            'addLessVariables' => '
                @header-height: ' . $this->getOption('header-height') . ';
                @body-font: ' . $this->getOption('bodyFont') . ';
                @body-color: ' . $this->getOption('bodyColor') . ';
                @footer-height: ' . $this->getOption('footerHeight') . ';
                @footer-color: ' . $this->getOption('footerColor') . ';
                @article-margin: ' . $this->getOption('articleMargin') . ';
                @article-title-font: ' . $this->getOption('articleTitleFont') . ';
            ',
        ]);

        if ($this->getOption('stickyHeader') === 'sticky') {
            $this->addStyle('stickyHeader', 'styles/stickyHeader.css');
        }
        
       
        
        

    }

    /**
     * Get the display name of this theme
     * @return string
     */
    public function getDisplayName()
    {
        return __('plugins.themes.solonTheme.name');
    }

    /**
     * Get the description of this plugin
     * @return string
     */
    public function getDescription()
    {
        return __('plugins.themes.solonTheme.description');
    }

    /**
     * Get the name of the settings file to be installed on new journal creation.
     *
     * @return string
     */
    public function getContextSpecificPluginSettingsFile()
    {
        return $this->getPluginPath() . '/settings.xml';
    }

    /**
     * Get the name of the settings file to be installed site-wide when OJS is installed.
     *
     * @return string
     */
    public function getInstallSitePluginSettingsFile()
    {
        return $this->getPluginPath() . '/settings.xml';
    }
}

if (!PKP_STRICT_MODE) {
    class_alias('\APP\plugins\themes\solonTheme\solonThemePlugin', '\solonThemePlugin');
}
?>