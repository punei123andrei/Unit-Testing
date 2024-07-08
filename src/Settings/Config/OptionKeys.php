<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Settings\Config;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Settings\Config
 * @since 1.0.3
 */

 class OptionKeys
 { 
    private string $optionGroup;

    private string $optionName;

    private string $optionSection;

    private string $optionTitle;

    private string $pageSlug;

    private string $fieldId;

    private string $fieldTitle;

    /**
     * Get the value of optionGroup
     */ 
    public function getOptionGroup()
    {
        return $this->optionGroup;
    }

    /**
     * Set the value of optionGroup
     *
     * @return  self
     */ 
    public function setOptionGroup($optionGroup)
    {
        $this->optionGroup = $optionGroup;

        return $this;
    }

    /**
     * Get the value of optionName
     */ 
    public function getOptionName()
    {
        return $this->optionName;
    }

    /**
     * Set the value of optionName
     *
     * @return  self
     */ 
    public function setOptionName($optionName)
    {
        $this->optionName = $optionName;

        return $this;
    }

    /**
     * Get the value of optionSection
     */ 
    public function getOptionSection()
    {
        return $this->optionSection;
    }

    /**
     * Set the value of optionSection
     *
     * @return  self
     */ 
    public function setOptionSection($optionSection)
    {
        $this->optionSection = $optionSection;

        return $this;
    }

    /**
     * Get the value of optionTitle
     */ 
    public function getOptionTitle()
    {
        return $this->optionTitle;
    }

    /**
     * Set the value of optionTitle
     *
     * @return  self
     */ 
    public function setOptionTitle($optionTitle)
    {
        $this->optionTitle = $optionTitle;

        return $this;
    }

    /**
     * Get the value of pageSlug
     */ 
    public function getPageSlug()
    {
        return $this->pageSlug;
    }

    /**
     * Set the value of pageSlug
     *
     * @return  self
     */ 
    public function setPageSlug($pageSlug)
    {
        $this->pageSlug = $pageSlug;

        return $this;
    }

    /**
     * Get the value of fieldId
     */ 
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * Set the value of fieldId
     *
     * @return  self
     */ 
    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;

        return $this;
    }

    /**
     * Get the value of fieldTitle
     */ 
    public function getFieldTitle()
    {
        return $this->fieldTitle;
    }

    /**
     * Set the value of fieldTitle
     *
     * @return  self
     */ 
    public function setFieldTitle($fieldTitle)
    {
        $this->fieldTitle = $fieldTitle;

        return $this;
    }
 }