# Contributing Guide

## Getting Started

Thank you for considering contributing to Sierra Shop! This document explains the process for contributing to the project.

## Code of Conduct

This project adheres to a Code of Conduct that all contributors are expected to follow. Please read [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) before contributing.

## How Can I Contribute?

### Reporting Bugs

1. Check the issue tracker to avoid duplicates
2. Create a new issue if none exists
3. Include in your bug report:
   - Steps to reproduce
   - Expected behavior
   - Actual behavior
   - Screenshots if applicable
   - System information

### Suggesting Enhancements

1. Check existing enhancement requests
2. Create a new issue with:
   - Clear description of the feature
   - Use cases
   - Possible implementation approach
   - Mock-ups if applicable

### Pull Requests

1. Fork the repository
2. Create a new branch
3. Make your changes
4. Test thoroughly
5. Submit pull request

## Development Process

### Setting Up Development Environment

1. Fork and clone the repository:
   ```bash
   git clone https://github.com/yourusername/SierraShop.git
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up database:
   ```bash
   mysql -u root -p < admin/database/db.sql
   ```

4. Configure environment:
   ```bash
   cp lib/config/config.example.php lib/config/config.php
   cp lib/config/database.example.php lib/config/database.php
   ```

### Coding Standards

1. **PHP Code Style**
   - Follow PSR-12 coding standards
   - Use meaningful variable names
   - Comment complex logic
   - Keep functions focused and small

2. **File Organization**
   - Follow MVC pattern
   - Group related functionality
   - Use meaningful filenames

3. **Documentation**
   - Document all public methods
   - Include PHPDoc blocks
   - Update relevant documentation

### Testing

1. **Unit Tests**
   - Write tests for new features
   - Update tests for changes
   - Run tests before committing:
     ```bash
     ./vendor/bin/phpunit
     ```

2. **Integration Tests**
   - Test database operations
   - Test API endpoints
   - Verify frontend integration

### Git Workflow

1. **Branching**
   ```bash
   # Create feature branch
   git checkout -b feature/your-feature-name
   
   # Create bugfix branch
   git checkout -b fix/bug-description
   ```

2. **Commits**
   - Write clear commit messages
   - Reference issues when applicable
   - Keep commits focused
   ```bash
   git commit -m "feat: Add product search functionality
   
   Implements #123"
   ```

3. **Pull Requests**
   - Reference related issues
   - Describe changes clearly
   - Include testing instructions
   - Add screenshots if applicable

## Release Process

### Version Numbering

Follow Semantic Versioning:
- MAJOR.MINOR.PATCH
- Major: Breaking changes
- Minor: New features
- Patch: Bug fixes

### Release Steps

1. Update version number
2. Update CHANGELOG.md
3. Create release notes
4. Tag release
5. Deploy to production

## Documentation

### Code Documentation

1. **PHPDoc Blocks**
   ```php
   /**
    * Process user order
    *
    * @param int $userId User identifier
    * @param array $items Order items
    * @return Order
    * @throws OrderException
    */
   public function processOrder($userId, array $items)
   ```

2. **README Updates**
   - Update for new features
   - Keep examples current
   - Update requirements

3. **API Documentation**
   - Document new endpoints
   - Update request/response examples
   - Note deprecations

## Community

### Getting Help

- GitHub Discussions
- Issue Tracker
- Project Wiki

### Communication Channels

- GitHub Issues
- Development Blog
- Community Forums

## License

By contributing, you agree that your contributions will be licensed under the project's license. See [LICENSE.md](LICENSE.md) for details.
