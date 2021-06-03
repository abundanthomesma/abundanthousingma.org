module.exports = {
  'extends': 'stylelint-config-recommended-scss',
  'plugins': [
    'stylelint-scss',
  ],
  'rules': {
    'no-empty-source': null,
    'string-quotes': 'double',
    'at-rule-empty-line-before': null,
    'at-rule-no-unknown': null,
    'scss/at-rule-no-unknown': true,
  },
};
