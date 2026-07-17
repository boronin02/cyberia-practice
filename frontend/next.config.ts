const hostnames = process.env.NEXT_PUBLIC_IMAGE_HOSTNAMES?.split(",") || ["localhost"];

/** @type {import('next').NextConfig} */
const nextConfig = {
  images: {
    remotePatterns: hostnames.map((hostname) => ({
      protocol: process.env.NEXT_PUBLIC_IMAGE_PROTOCOL || "http",
      hostname: hostname.trim(),
      port: process.env.NEXT_PUBLIC_IMAGE_PORT || "",
      pathname: "/**",
    })),
  },
  async rewrites() {
    return [
      {
        source: "/api/:path*",
        destination: "http://localhost:8000/api/:path*",
      },
    ];
  },
};

export default nextConfig;
