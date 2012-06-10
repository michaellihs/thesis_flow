<?php return array (
  'Settings' => 
  array (
    'TYPO3' => 
    array (
      'FLOW3' => 
      array (
        'aop' => 
        array (
          'globalObjects' => 
          array (
            'securityContext' => 'TYPO3\\FLOW3\\Security\\Context',
          ),
        ),
        'configuration' => 
        array (
          'compileConfigurationFiles' => true,
        ),
        'core' => 
        array (
          'context' => 'Production',
          'phpBinaryPathAndFilename' => '/usr/bin/php',
        ),
        'error' => 
        array (
          'exceptionHandler' => 
          array (
            'className' => 'TYPO3\\FLOW3\\Error\\ProductionExceptionHandler',
          ),
          'errorHandler' => 
          array (
            'exceptionalErrors' => 
            array (
              0 => '256',
              1 => '4096',
            ),
          ),
        ),
        'http' => 
        array (
          'baseUri' => NULL,
        ),
        'log' => 
        array (
          'systemLogger' => 
          array (
            'backend' => 'TYPO3\\FLOW3\\Log\\Backend\\FileBackend',
            'backendOptions' => 
            array (
              'logFileURL' => '/var/www/kunden/thesis/Data/Logs/System.log',
              'createParentDirectories' => true,
              'severityThreshold' => '6',
              'maximumLogFileSize' => 10485760,
              'logFilesToKeep' => 1,
              'logMessageOrigin' => false,
            ),
          ),
          'securityLogger' => 
          array (
            'backend' => 'TYPO3\\FLOW3\\Log\\Backend\\FileBackend',
            'backendOptions' => 
            array (
              'logFileURL' => '/var/www/kunden/thesis/Data/Logs/Security.log',
              'createParentDirectories' => true,
              'severityThreshold' => '6',
              'maximumLogFileSize' => 10485760,
              'logFilesToKeep' => 1,
              'logIpAddress' => true,
            ),
          ),
        ),
        'i18n' => 
        array (
          'defaultLocale' => 'en',
          'fallbackRule' => 
          array (
            'strict' => false,
            'order' => 
            array (
            ),
          ),
        ),
        'mvc' => 
        array (
          'notFoundController' => 'TYPO3\\FLOW3\\Mvc\\Controller\\NotFoundController',
        ),
        'object' => 
        array (
          'registerFunctionalTestClasses' => false,
        ),
        'package' => 
        array (
          'git' => 
          array (
            'gitBinary' => '/usr/bin/env git',
          ),
        ),
        'persistence' => 
        array (
          'backendOptions' => 
          array (
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'dbname' => NULL,
            'user' => NULL,
            'password' => NULL,
            'charset' => 'utf8',
          ),
          'doctrine' => 
          array (
            'cacheImplementation' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'sqlLogger' => NULL,
            'enable' => true,
          ),
        ),
        'reflection' => 
        array (
          'ignoredTags' => 
          array (
            0 => 'api',
            1 => 'package',
            2 => 'subpackage',
            3 => 'license',
            4 => 'copyright',
            5 => 'author',
            6 => 'const',
            7 => 'see',
            8 => 'todo',
            9 => 'scope',
            10 => 'fixme',
            11 => 'test',
            12 => 'expectedException',
            13 => 'dataProvider',
            14 => 'group',
            15 => 'codeCoverageIgnore',
          ),
          'logIncorrectDocCommentHints' => false,
        ),
        'resource' => 
        array (
          'publishing' => 
          array (
            'detectPackageResourceChanges' => false,
            'fileSystem' => 
            array (
              'mirrorMode' => 'link',
            ),
          ),
        ),
        'security' => 
        array (
          'enable' => true,
          'firewall' => 
          array (
            'rejectAll' => false,
            'filters' => 
            array (
              0 => 
              array (
                'patternType' => 'CsrfProtection',
                'patternValue' => NULL,
                'interceptor' => 'AccessDeny',
              ),
            ),
          ),
          'authentication' => 
          array (
            'providers' => 
            array (
            ),
            'authenticationStrategy' => 'atLeastOneToken',
          ),
          'authorization' => 
          array (
            'accessDecisionVoters' => 
            array (
              0 => 'TYPO3\\FLOW3\\Security\\Authorization\\Voter\\Policy',
            ),
            'allowAccessIfAllVotersAbstain' => false,
          ),
          'csrf' => 
          array (
            'csrfStrategy' => 'onePerSession',
          ),
          'cryptography' => 
          array (
            'hashingStrategies' => 
            array (
              'default' => 'bcrypt',
              'fallback' => 'pbkdf2',
              'pbkdf2' => 'TYPO3\\FLOW3\\Security\\Cryptography\\Pbkdf2HashingStrategy',
              'bcrypt' => 'TYPO3\\FLOW3\\Security\\Cryptography\\BCryptHashingStrategy',
              'saltedmd5' => 'TYPO3\\FLOW3\\Security\\Cryptography\\SaltedMd5HashingStrategy',
            ),
            'Pbkdf2HashingStrategy' => 
            array (
              'dynamicSaltLength' => 8,
              'iterationCount' => 10000,
              'derivedKeyLength' => 64,
              'algorithm' => 'sha256',
            ),
            'BCryptHashingStrategy' => 
            array (
              'cost' => 14,
            ),
            'RSAWalletServicePHP' => 
            array (
              'keystorePath' => '/var/www/kunden/thesis/Data/Persistent/RsaWalletData',
              'openSSLConfiguration' => 
              array (
              ),
            ),
          ),
        ),
        'session' => 
        array (
          'inactivityTimeout' => 3600,
          'PHPSession' => 
          array (
            'name' => 'FLOW3',
            'savePath' => NULL,
            'cookie' => 
            array (
              'lifetime' => 0,
              'path' => '/',
              'secure' => false,
              'httponly' => true,
            ),
          ),
        ),
        'utility' => 
        array (
          'environment' => 
          array (
            'temporaryDirectoryBase' => '/var/www/kunden/thesis/Data/Temporary/',
          ),
        ),
      ),
      'Fluid' => 
      array (
      ),
      'Kickstart' => 
      array (
      ),
      'Party' => 
      array (
      ),
      'Welcome' => 
      array (
      ),
    ),
    'Doctrine' => 
    array (
      'Common' => 
      array (
      ),
      'DBAL' => 
      array (
      ),
      'ORM' => 
      array (
      ),
    ),
    'MKnoll' => 
    array (
      'Thesis' => 
      array (
      ),
    ),
    'Symfony' => 
    array (
      'Component' => 
      array (
        'DomCrawler' => 
        array (
        ),
        'Yaml' => 
        array (
        ),
      ),
    ),
  ),
  'Caches' => 
  array (
    'Default' => 
    array (
      'frontend' => 'TYPO3\\FLOW3\\Cache\\Frontend\\VariableFrontend',
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\FileBackend',
      'backendOptions' => 
      array (
        'defaultLifetime' => 0,
      ),
    ),
    'FLOW3_Cache_ResourceFiles' => 
    array (
    ),
    'FLOW3_Core' => 
    array (
      'frontend' => 'TYPO3\\FLOW3\\Cache\\Frontend\\StringFrontend',
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\SimpleFileBackend',
    ),
    'FLOW3_I18n_AvailableLocalesCache' => 
    array (
    ),
    'FLOW3_I18n_XmlModelCache' => 
    array (
    ),
    'FLOW3_I18n_Cldr_CldrModelCache' => 
    array (
    ),
    'FLOW3_I18n_Cldr_Reader_DatesReaderCache' => 
    array (
    ),
    'FLOW3_I18n_Cldr_Reader_NumbersReaderCache' => 
    array (
    ),
    'FLOW3_I18n_Cldr_Reader_PluralsReaderCache' => 
    array (
    ),
    'FLOW3_Monitor' => 
    array (
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\SimpleFileBackend',
    ),
    'FLOW3_Mvc_Routing_FindMatchResults' => 
    array (
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\TransientMemoryBackend',
      'backendOptions' => 
      array (
        'defaultLifetime' => 0,
      ),
    ),
    'FLOW3_Mvc_Routing_Resolve' => 
    array (
      'frontend' => 'TYPO3\\FLOW3\\Cache\\Frontend\\StringFrontend',
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\TransientMemoryBackend',
      'backendOptions' => 
      array (
        'defaultLifetime' => 0,
      ),
    ),
    'FLOW3_Object_Classes' => 
    array (
      'frontend' => 'TYPO3\\FLOW3\\Cache\\Frontend\\PhpFrontend',
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\SimpleFileBackend',
    ),
    'FLOW3_Object_Configuration' => 
    array (
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\SimpleFileBackend',
    ),
    'FLOW3_Reflection_Status' => 
    array (
      'frontend' => 'TYPO3\\FLOW3\\Cache\\Frontend\\StringFrontend',
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\SimpleFileBackend',
    ),
    'FLOW3_Reflection_CompiletimeData' => 
    array (
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\SimpleFileBackend',
    ),
    'FLOW3_Reflection_RuntimeData' => 
    array (
    ),
    'FLOW3_Reflection_RuntimeClassSchemata' => 
    array (
    ),
    'FLOW3_Resource_Status' => 
    array (
      'frontend' => 'TYPO3\\FLOW3\\Cache\\Frontend\\StringFrontend',
    ),
    'FLOW3_Security_Policy' => 
    array (
    ),
    'FLOW3_Security_Cryptography_RSAWallet' => 
    array (
      'backendOptions' => 
      array (
        'defaultLifetime' => 30,
      ),
    ),
    'Fluid_TemplateCache' => 
    array (
      'frontend' => 'TYPO3\\FLOW3\\Cache\\Frontend\\PhpFrontend',
      'backend' => 'TYPO3\\FLOW3\\Cache\\Backend\\FileBackend',
    ),
  ),
  'Objects' => 
  array (
    'Doctrine.Common' => 
    array (
    ),
    'Doctrine.DBAL' => 
    array (
    ),
    'Doctrine.ORM' => 
    array (
    ),
    'MKnoll.Thesis' => 
    array (
    ),
    'Symfony.Component.DomCrawler' => 
    array (
    ),
    'Symfony.Component.Yaml' => 
    array (
    ),
    'TYPO3.FLOW3' => 
    array (
      'DateTime' => 
      array (
        'scope' => 'prototype',
        'autowiring' => 'off',
      ),
      'TYPO3\\FLOW3\\Cache\\CacheFactory' => 
      array (
        'arguments' => 
        array (
          1 => 
          array (
            'setting' => 'TYPO3.FLOW3.context',
          ),
        ),
      ),
      'TYPO3\\FLOW3\\I18n\\Service' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_I18n_AvailableLocalesCache',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\I18n\\Cldr\\CldrModel' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_I18n_Cldr_CldrModelCache',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\I18n\\Xliff\\XliffModel' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_I18n_XmlModelCache',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\I18n\\Cldr\\Reader\\DatesReader' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_I18n_Cldr_Reader_DatesReaderCache',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\I18n\\Cldr\\Reader\\NumbersReader' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_I18n_Cldr_Reader_NumbersReaderCache',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\I18n\\Cldr\\Reader\\PluralsReader' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_I18n_Cldr_Reader_PluralsReaderCache',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Log\\Backend\\FileBackend' => 
      array (
        'autowiring' => 'off',
      ),
      'TYPO3\\FLOW3\\Log\\Backend\\NullBackend' => 
      array (
        'autowiring' => 'off',
      ),
      'TYPO3\\FLOW3\\Log\\SystemLoggerInterface' => 
      array (
        'scope' => 'singleton',
        'factoryObjectName' => 'TYPO3\\FLOW3\\Log\\LoggerFactory',
        'arguments' => 
        array (
          1 => 
          array (
            'value' => 'FLOW3_System',
          ),
          2 => 
          array (
            'value' => 'TYPO3\\FLOW3\\Log\\Logger',
          ),
          3 => 
          array (
            'value' => 'TYPO3\\FLOW3\\Log\\Backend\\FileBackend',
          ),
          4 => 
          array (
            'setting' => 'TYPO3.FLOW3.log.systemLogger.backendOptions',
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Log\\SecurityLoggerInterface' => 
      array (
        'scope' => 'singleton',
        'factoryObjectName' => 'TYPO3\\FLOW3\\Log\\LoggerFactory',
        'arguments' => 
        array (
          1 => 
          array (
            'value' => 'FLOW3_Security',
          ),
          2 => 
          array (
            'value' => 'TYPO3\\FLOW3\\Log\\Logger',
          ),
          3 => 
          array (
            'value' => 'TYPO3\\FLOW3\\Log\\Backend\\FileBackend',
          ),
          4 => 
          array (
            'setting' => 'TYPO3.FLOW3.log.securityLogger.backendOptions',
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Monitor\\ChangeDetectionStrategy\\ModificationTimeStrategy' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_Monitor',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Monitor\\FileMonitor' => 
      array (
        'properties' => 
        array (
          'cache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_Monitor',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Mvc\\Routing\\Aspect\\RouterCachingAspect' => 
      array (
        'properties' => 
        array (
          'findMatchResultsCache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_Mvc_Routing_FindMatchResults',
                ),
              ),
            ),
          ),
          'resolveCache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_Mvc_Routing_Resolve',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Object\\ObjectManagerInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Object\\ObjectManager',
        'scope' => 'singleton',
        'autowiring' => 'off',
      ),
      'TYPO3\\FLOW3\\Object\\ObjectManager' => 
      array (
        'autowiring' => 'off',
      ),
      'TYPO3\\FLOW3\\Object\\CompileTimeObjectManager' => 
      array (
        'autowiring' => 'off',
      ),
      'Doctrine\\Common\\Persistence\\ObjectManager' => 
      array (
        'scope' => 'singleton',
        'factoryObjectName' => 'TYPO3\\FLOW3\\Persistence\\Doctrine\\EntityManagerFactory',
      ),
      'TYPO3\\FLOW3\\Persistence\\PersistenceManagerInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Persistence\\Doctrine\\PersistenceManager',
      ),
      'TYPO3\\FLOW3\\Persistence\\Doctrine\\Logging\\SqlLogger' => 
      array (
        'properties' => 
        array (
          'logger' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Log\\LoggerFactory',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'Sql_Queries',
                ),
                2 => 
                array (
                  'value' => 'TYPO3\\FLOW3\\Log\\Logger',
                ),
                3 => 
                array (
                  'value' => 'TYPO3\\FLOW3\\Log\\Backend\\FileBackend',
                ),
                4 => 
                array (
                  'setting' => 'TYPO3.FLOW3.log.sqlLogger.backendOptions',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Resource\\ResourceManager' => 
      array (
        'properties' => 
        array (
          'statusCache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_Resource_Status',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Resource\\Publishing\\ResourcePublishingTargetInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Resource\\Publishing\\FileSystemPublishingTarget',
      ),
      'TYPO3\\FLOW3\\Security\\Authentication\\AuthenticationManagerInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Security\\Authentication\\AuthenticationProviderManager',
      ),
      'TYPO3\\FLOW3\\Security\\Cryptography\\RsaWalletServiceInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Security\\Cryptography\\RsaWalletServicePhp',
        'scope' => 'singleton',
        'properties' => 
        array (
          'keystoreCache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'FLOW3_Security_Cryptography_RSAWallet',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Security\\Authorization\\AccessDecisionManagerInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Security\\Authorization\\AccessDecisionVoterManager',
      ),
      'TYPO3\\FLOW3\\Security\\Authorization\\FirewallInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Security\\Authorization\\FilterFirewall',
      ),
      'TYPO3\\FLOW3\\Security\\Cryptography\\Pbkdf2HashingStrategy' => 
      array (
        'scope' => 'singleton',
        'arguments' => 
        array (
          1 => 
          array (
            'setting' => 'TYPO3.FLOW3.security.cryptography.Pbkdf2HashingStrategy.dynamicSaltLength',
          ),
          2 => 
          array (
            'setting' => 'TYPO3.FLOW3.security.cryptography.Pbkdf2HashingStrategy.iterationCount',
          ),
          3 => 
          array (
            'setting' => 'TYPO3.FLOW3.security.cryptography.Pbkdf2HashingStrategy.derivedKeyLength',
          ),
          4 => 
          array (
            'setting' => 'TYPO3.FLOW3.security.cryptography.Pbkdf2HashingStrategy.algorithm',
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Security\\Cryptography\\BCryptHashingStrategy' => 
      array (
        'scope' => 'singleton',
        'arguments' => 
        array (
          1 => 
          array (
            'setting' => 'TYPO3.FLOW3.security.cryptography.BCryptHashingStrategy.cost',
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Session\\SessionInterface' => 
      array (
        'className' => 'TYPO3\\FLOW3\\Session\\PhpSession',
        'scope' => 'singleton',
        'properties' => 
        array (
          'settings' => 
          array (
            'setting' => 'TYPO3.FLOW3',
          ),
          'environment' => 
          array (
            'object' => 'TYPO3\\FLOW3\\Utility\\Environment',
          ),
        ),
      ),
      'TYPO3\\FLOW3\\Utility\\PdoHelper' => 
      array (
        'autowiring' => 'off',
        'scope' => 'prototype',
      ),
    ),
    'TYPO3.Fluid' => 
    array (
      'TYPO3\\Fluid\\Core\\Compiler\\TemplateCompiler' => 
      array (
        'properties' => 
        array (
          'templateCache' => 
          array (
            'object' => 
            array (
              'factoryObjectName' => 'TYPO3\\FLOW3\\Cache\\CacheManager',
              'factoryMethodName' => 'getCache',
              'arguments' => 
              array (
                1 => 
                array (
                  'value' => 'Fluid_TemplateCache',
                ),
              ),
            ),
          ),
        ),
      ),
      'TYPO3\\Fluid\\View\\TemplateView' => 
      array (
        'properties' => 
        array (
          'renderingContext' => 
          array (
            'object' => 'TYPO3\\Fluid\\Core\\Rendering\\RenderingContext',
          ),
        ),
      ),
      'TYPO3\\Fluid\\View\\StandaloneView' => 
      array (
        'properties' => 
        array (
          'renderingContext' => 
          array (
            'object' => 'TYPO3\\Fluid\\Core\\Rendering\\RenderingContext',
          ),
        ),
      ),
    ),
    'TYPO3.Kickstart' => 
    array (
    ),
    'TYPO3.Party' => 
    array (
    ),
    'TYPO3.Welcome' => 
    array (
    ),
  ),
  'Policy' => 
  array (
    'resources' => 
    array (
      'entities' => 
      array (
      ),
      'methods' => 
      array (
      ),
    ),
    'roles' => 
    array (
    ),
    'acls' => 
    array (
    ),
  ),
)?>