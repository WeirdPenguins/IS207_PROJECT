<?php
class Database
{
    private const HOST = 'localhost';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const DBNAME = 'rebook';
    private static $connection = null;

    /**
     * Tạo kết nối với CSDL
     */
    private static function Connect()
    {
        if (self::$connection === null) {
            self::$connection = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DBNAME);
            if (self::$connection->connect_error) {
                error_log("Database connection failed: " . self::$connection->connect_error);
                throw new Exception("Database connection failed");
            }
            self::$connection->set_charset("utf8mb4");
        }
        return self::$connection;
    }

    /**
     * Escape string để tránh SQL injection
     */
    public static function Escape($value)
    {
        $conn = self::Connect();
        if (is_array($value)) {
            return array_map([self::class, 'Escape'], $value);
        }
        return $conn->real_escape_string($value);
    }

    /**
     * Sử dụng cho câu truy vấn SELECT
     * @param string $query Câu truy vấn
     * @param array $format Định dạng kết quả trả về.
     * $format = ['row' => int, 'cell' => int|string]
     * @return array $arr
     */
    public static function GetData($query, $format = [])
    {
        try {
            $connect = self::Connect();
            $resQuery = $connect->query($query);

            if (!$resQuery) {
                error_log("Query failed: " . $connect->error . " Query: " . $query);
                throw new Exception("Query failed: " . $connect->error);
            }

            $arr = [];
            if ($resQuery->num_rows > 0) {
                while ($row = $resQuery->fetch_assoc()) {
                    $arr[] = $row;
                }

                // Trả về một giá trị theo key hoặc index
                if (isset($format['cell'])) {
                    $formatRow = isset($format['row']) ? $format['row'] : 0;
                    $formatKey = is_numeric($format['cell']) ? array_keys($arr[$formatRow])[$format['cell']] : $format['cell'];
                    return isset($formatRow) ? $arr[$formatRow][$formatKey] : $arr[0][$formatKey];
                }

                // Trả về một dòng dữ liệu tại index
                if (isset($format['row'])) {
                    return $arr[$format['row']];
                }
            }
            return $arr;
        } catch (Exception $e) {
            error_log("GetData error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Sử dụng cho câu truy vấn SELECT có tính năng phân trang
     */
    public static function GetDataWithPagination($query, $offset = 10, $page = 1)
    {
        try {
            $countAll = self::GetData('SELECT count(*) FROM categories', ['cell' => 0]);

            $start = ($page - 1) * $offset;
            $data = self::GetData($query . " LIMIT $start, $offset");
            $end = $start + count($data);
            return [
                'data'        => $data,
                'start'       => $start + 1,
                'end'         => $end,
                'countAll'    => $countAll,
                'page_number' => ceil($countAll / $offset),
            ];
        } catch (Exception $e) {
            error_log("GetDataWithPagination error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Dùng cho truy vấn INSERT, UPDATE, DELETE
     */
    public static function NonQuery($query)
    {
        try {
            $connect = self::Connect();
            $result = $connect->query($query);
            if (!$result) {
                error_log("NonQuery failed: " . $connect->error . " Query: " . $query);
                throw new Exception("Query failed: " . $connect->error);
            }
            return $result;
        } catch (Exception $e) {
            error_log("NonQuery error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Đóng kết nối database
     */
    public static function Close()
    {
        if (self::$connection !== null) {
            self::$connection->close();
            self::$connection = null;
        }
    }
}