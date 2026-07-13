import { Unbounded, Wix_Madefor_Text } from "next/font/google";
import "@/shared/assets/styles/reset.scss";
import "@/shared/assets/styles/global.scss";
import { QueryProvider } from "@/shared/providers/queryProvider";
import { Header } from "@/widgets/Header";
import { Footer } from "@/widgets/Footer";

const unbounded = Unbounded({
  subsets: ["cyrillic"],
  variable: "--font-unbounded",
});

const wixMadeforText = Wix_Madefor_Text({
  subsets: ["cyrillic"],
  variable: "--font-wixMadeforText",
});

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="ru" className={`${unbounded.variable} ${wixMadeforText.variable}`}>
      <body>
        <QueryProvider>
          <Header />
          <main>{children}</main>
          <Footer />
        </QueryProvider>
      </body>
    </html>
  );
}
