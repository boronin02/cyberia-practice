import { Unbounded, Wix_Madefor_Text } from "next/font/google";
import "@/shared/assets/styles/reset.scss";
import "@/shared/assets/styles/global.scss";
import { QueryProvider } from "@/shared/providers/queryProvider";
import { Header } from "@/widgets/Header";
import { Footer } from "@/widgets/Footer";
import { fetchContacts } from "@/entities/contacts/api/contactsApi";
import clsx from "clsx";

const unbounded = Unbounded({
  subsets: ["cyrillic"],
  variable: "--font-unbounded",
});

const wixMadeforText = Wix_Madefor_Text({
  subsets: ["cyrillic"],
  variable: "--font-wixMadeforText",
});

export const metadata = {
  title: process.env.NEXT_PUBLIC_APP_NAME,
};

export default async function RootLayout({ children }: { children: React.ReactNode }) {
  const contactsData = await fetchContacts();
  const contacts = contactsData.data || [];

  return (
    <html lang="ru" className={clsx(unbounded.variable, wixMadeforText.variable)}>
      <body>
        <QueryProvider>
          <Header />
          <main>{children}</main>
          <Footer contacts={contacts} />
        </QueryProvider>
      </body>
    </html>
  );
}
