# DBConnect Pro - Advanced Database Management Tool

A powerful, fast, and optimized database management tool that goes beyond traditional database admin tools like Adminer. Built with modern PHP and featuring a beautiful, responsive interface.

## 🚀 Features

### Core Database Management
- **Multi-Database Support**: MySQL, PostgreSQL, SQLite, SQL Server
- **Advanced Query Interface**: Syntax highlighting, auto-completion, query templates
- **Real-time Query Execution**: Instant results with performance metrics
- **Query History & Logging**: Track and analyze all executed queries
- **Connection Pooling**: Optimized database connections for better performance

### Security Features
- **SQL Injection Protection**: Advanced pattern detection and prevention
- **Rate Limiting**: Configurable request limits per IP
- **Input Sanitization**: Comprehensive data validation and cleaning
- **Security Logging**: Track suspicious activities and security events
- **IP Blocking**: Automatic blocking of malicious IPs

### Database Visualization
- **ER Diagram Generation**: Visual representation of database relationships
- **Schema Documentation**: Automatic generation of database documentation
- **Table Relationship Mapping**: Interactive relationship visualization
- **Database Statistics**: Comprehensive database and table metrics

### Performance Optimization
- **Query Performance Analysis**: Detailed execution plan analysis
- **Index Recommendations**: AI-powered index suggestions
- **Performance Metrics**: Real-time database performance monitoring
- **Optimization Suggestions**: Automated performance improvement recommendations
- **Query Profiling**: Detailed query execution analysis

### Table Management
- **Advanced Table Operations**: Create, alter, drop, and manage tables
- **Data Import/Export**: Support for CSV, JSON, SQL, and XML formats
- **Bulk Operations**: Efficient handling of large datasets
- **Table Optimization**: Built-in table repair and optimization tools
- **Schema Migration**: Easy database schema modifications

### User Interface
- **Modern Design**: Beautiful, responsive interface with dark/light themes
- **Real-time Updates**: Live database information and statistics
- **Keyboard Shortcuts**: Power user features for efficient navigation
- **Export Functionality**: Save queries, results, and database schemas
- **Multi-tab Support**: Work with multiple queries simultaneously

## 🛠 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7+ / PostgreSQL 10+ / SQLite 3+ / SQL Server 2016+
- Web server (Apache/Nginx)
- Composer

### Quick Start

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd dbconnect
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp backend/config/.env.example backend/config/.env
   # Edit the .env file with your database settings
   ```

4. **Set permissions**
   ```bash
   chmod -R 755 backend/storage
   chmod -R 755 backend/config
   ```

5. **Access the application**
   Open your browser and navigate to the application URL.

## 📖 Usage

### Connecting to a Database

1. Open the application in your browser
2. Select your database type (MySQL, PostgreSQL, SQLite, SQL Server)
3. Enter connection details (host, port, username, password, database)
4. Click "Connect" or "Test" to verify the connection

### Running Queries

1. Use the query editor with syntax highlighting
2. Select from predefined query templates
3. Execute queries with Ctrl+Enter or click the Execute button
4. View results in the formatted table
5. Analyze query performance with the Explain feature

### Managing Tables

1. View all tables in the sidebar
2. Click on table actions to view structure, export, or manage data
3. Use the table management interface for advanced operations
4. Import/export data in various formats

### Performance Optimization

1. Access the Performance tab to view database metrics
2. Run optimization recommendations
3. Analyze query performance
4. Monitor database health and statistics

## 🔧 API Endpoints

### Database Connection
- `POST /backend/api/database/connect` - Connect to database
- `POST /backend/api/database/test` - Test database connection
- `GET /backend/api/database/info` - Get database information

### Query Execution
- `POST /backend/api/database/query` - Execute SQL query
- `POST /backend/api/database/explain` - Analyze query execution plan

### Table Management
- `GET /backend/api/database/tables` - List all tables
- `GET /backend/api/database/tables/{table}/structure` - Get table structure
- `POST /backend/api/database/tables` - Create new table
- `PUT /backend/api/database/tables/{table}` - Modify table
- `DELETE /backend/api/database/tables/{table}` - Drop table

### Data Import/Export
- `GET /backend/api/database/export/{table}` - Export table data
- `POST /backend/api/database/tables/{table}/import` - Import data

### Performance & Visualization
- `GET /backend/api/database/visualization` - Get schema visualization
- `GET /backend/api/database/er-diagram` - Generate ER diagram
- `GET /backend/api/database/performance/metrics` - Get performance metrics
- `GET /backend/api/database/performance/recommendations` - Get optimization recommendations

## 🔒 Security

### Built-in Security Features
- **SQL Injection Protection**: Advanced pattern detection
- **Rate Limiting**: Configurable per-IP request limits
- **Input Validation**: Comprehensive data sanitization
- **Security Headers**: Modern security header implementation
- **Access Control**: IP-based access restrictions

### Security Configuration
```php
// Rate limiting configuration
$rateLimit = [
    'requests' => 100,    // Max requests per window
    'window' => 60,       // Time window in seconds
];

// Allowed operations (read-only by default)
$allowedOperations = [
    'SELECT', 'SHOW', 'DESCRIBE', 'EXPLAIN'
];
```

## 🎨 Customization

### Themes
The interface supports custom themes and can be easily customized:
- Modern gradient design
- Responsive layout
- Dark/light mode support
- Custom color schemes

### Query Templates
Add custom query templates:
```javascript
// Add to the template buttons section
<button class="template-btn" onclick="insertTemplate('YOUR_CUSTOM_QUERY')">
    Your Template
</button>
```

## 📊 Performance Features

### Query Analysis
- **Execution Plan Analysis**: Detailed query optimization insights
- **Performance Scoring**: Automated performance rating system
- **Index Recommendations**: AI-powered indexing suggestions
- **Query Profiling**: Real-time execution metrics

### Database Optimization
- **Automatic Optimization**: Built-in table optimization tools
- **Performance Monitoring**: Real-time database health metrics
- **Resource Usage**: Connection and memory usage tracking
- **Optimization History**: Track optimization improvements

## 🔧 Configuration

### Environment Variables
```env
# Database Configuration
DB_TYPE=mysql
DB_HOST=localhost
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=

# Security Settings
SECRET_KEY=your-secret-key
RATE_LIMIT_REQUESTS=100
RATE_LIMIT_WINDOW=60

# Application Settings
APP_NAME=DBConnect Pro
APP_VERSION=1.0.0
APP_DEBUG=true
```

### Database Configuration
```php
// config/database.php
return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => 3306,
            // ... other settings
        ],
        // ... other database types
    ]
];
```

## 🚀 Advanced Features

### Query Builder
Built-in query builder for complex queries:
```php
$query = new QueryBuilder();
$query->select(['id', 'name', 'email'])
      ->from('users')
      ->where('active', '=', 1)
      ->where('created_at', '>', '2023-01-01')
      ->orderBy('name', 'ASC')
      ->limit(100);

$sql = $query->toSql();
```

### Bulk Operations
Efficient handling of large datasets:
- Batch insert operations
- Bulk update capabilities
- Mass delete with safety checks
- Progress tracking for long operations

### Data Visualization
Advanced data visualization features:
- Interactive charts and graphs
- Database relationship diagrams
- Performance trend analysis
- Custom dashboard creation

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Check the documentation
- Review the API reference

## 🎯 Roadmap

### Upcoming Features
- [ ] Real-time collaboration
- [ ] Advanced query scheduling
- [ ] Database backup/restore
- [ ] Multi-database synchronization
- [ ] Advanced reporting features
- [ ] Plugin system
- [ ] Mobile application
- [ ] Cloud deployment support

---

**DBConnect Pro** - The most powerful and user-friendly database management tool available. Built for developers, by developers.
"# dbconnect" 
