<?php

/**
 * PluginComment
 *
 * @package    vjCommentPlugin
 * @subpackage model
 * @author     Jean-Philippe MORVAN <jp.morvan@ville-villejuif.fr>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class PluginComment extends BaseComment
{
    public function getAuthor()
    {
      if(!is_null($this->getUserId()))
      {
        if(
          ($profile = $this->getProfileAlias()) !== false &&
          ($field = vjComment::getProfileInformation('field_name')) !== false
        )
        {
          return $profile->{'get'.$field}();
        }
        else
        {
          return $this->getUser()->getUsername();
        }
      }
      return $this->getAuthorName();
    }

    public function getEmail()
    {
      if(!is_null($this->getUserId()))
      {
        if(
          ($profile = $this->getProfileAlias()) !== false &&
          ($field = vjComment::getProfileInformation('field_email')) !== false
        )
        {
          return $profile->{'get'.$field}();
        }
      }
      return $this->getAuthorEmail();
    }

    public function getWebsite()
    {
      if(!is_null($this->getUserId()))
      {
        if(
          ($profile = $this->getProfileAlias()) !== false &&
          ($field = vjComment::getProfileInformation('field_website')) !== false
        )
        {
          return $profile->{'get'.$field}();
        }
      }
      return $this->getAuthorWebsite();
    }

    public function getProfileAlias()
    {
      if(($alias = vjComment::getProfileInformation('alias')))
      {
        return $this->getUser()->{'get'.$alias}();
      }
      return false;
    }
}